<?php echo $header?>
<!-- Top Fixed Bar: Breadcrumb -->
<div class="breadcrumb clearfix">

    <!-- Top Fixed Bar: Breadcrumb Container -->
    <div class="container">


        <!-- Top Fixed Bar: Breadcrumb Right Navigation -->
        <ul class="pull-right">

        </ul>
        <!-- / Top Fixed Bar: Breadcrumb Right Navigation -->

    </div>
    <!-- / Top Fixed Bar: Breadcrumb Container -->

</div>
<!-- / Top Fixed Bar: Breadcrumb -->
<div class="container">   
    <form id="PostToMPI" name="PostToMPI" method="post" action="https://www.e-tahsildar.com.tr/V2/NetProvOrtakOdeme/NetProvPost.aspx"> 
        <input type="hidden" name="pOrgNo" value="<?php echo $prepare_payment['pOrgNo']?>" /> 
        <input type="hidden" name="pFirmNo"  value="<?php echo $prepare_payment['pFirmNo']?>" /> 
        <input type="hidden" name="pTermNo" value="<?php echo $prepare_payment['pTermNo']?>" /> 
        <input type="hidden" name="pCardNo" value="<?php echo $prepare_payment['pCardNo']?>" /> 
        <input type="hidden" name="pCVV2" value="<?php echo $prepare_payment['pCVV2']?>" />
        <input type="hidden" name="pExpDate" value="<?php echo $prepare_payment['pExpDate']?>" />
        <input type="hidden" name="pAmount" value="<?php echo $prepare_payment['amount']?>" /> 
        <input type="hidden" name="pTaksit" value="0" /> 
        <input type="hidden" name="pXid" value="<?php echo $prepare_payment['pXid']?>" /> 
        <input type="hidden" name="pokUrl" value="<?php echo $prepare_payment['pokUrl']?>" /> 
        <input type="hidden" name="pfailUrl" value="<?php echo $prepare_payment['pfailUrl']?>" /> 
        <input type="hidden" name="pHashB64" value="" /> 
        <input type="hidden" name="pHashHex" value="" /> 
        <input type="hidden" name="pSipNo" value="<?php echo $prepare_payment['pSipNo']?>"/> 
        <input type="hidden" name="pCurrency" value="949"/> 
        <input type="hidden" name="pMPI3D" value="<?php echo $prepare_payment['secure']?>" />
        <img src="merchant/view/assets/img/logo-provus.png"/><br/>
        <table class="table">
            <tr>
                <td>Deposit By :</td>
                <td><?php echo $prepare_payment['customer_name']?></td>
            </tr>
            <tr>
                <td>Deposit Date :</td>
                <td><?php echo $prepare_payment['date']?></td>
            </tr>
            <tr>
                <td>Deposit Amount :</td>
                <td><?php echo $this->currency->format($prepare_payment['amount'] / 100, $this->config->get('config_currency'));?></td>
            </tr>
            <tr>
                <td>Description :</td>
                <td><?php echo $prepare_payment['description']?></td>
            </tr>
            <tr>
                <td>Card Number :</td>
                <td><?php echo $prepare_payment['pCardNoMasked']?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                </td>
            </tr>
        </table>

    </form>
    <button id="pay" class="btn btn-success pull-right">Pay Now!</button>
    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo $home?>'">Cancel Payment</button>
    <script>
        $("#pay").bind('click', function() {
            var pOrgNo = $('input[name=\'pOrgNo\']').val();
            var pFirmNo = $('input[name=\'pFirmNo\']').val();
            var pTermNo = $('input[name=\'pTermNo\']').val();
            var pCardNo = $('input[name=\'pCardNo\']').val();
            var pAmount = $('input[name=\'pAmount\']').val();
            var merchantKey = "<?php echo $prepare_payment['key']?>";

           hashdata = pOrgNo + pFirmNo + pTermNo + pCardNo + pAmount + merchantKey;

            $("input[name=\'pHashB64\']").val(createHash(hashdata));
            $("input[name=\'pHashHex\']").val(sha1Hash(pOrgNo + pFirmNo + pTermNo + pCardNo + pAmount + merchantKey));
            
            $('#PostToMPI').submit();
            
        });

        function createHash(hash)
        {
            //	var hashdata = pOrgNo + pFirmNo + pTermNo + pCardNo + pAmount +merchantKey;

            return encode64(sha1Hash(hash));
        }

        var keyStr = "ABCDEFGHIJKLMNOP" +
                "QRSTUVWXYZabcdef" +
                "ghijklmnopqrstuv" +
                "wxyz0123456789+/" +
                "=";

        function encode64(input) {
            var output = "";
            var chr1, chr2, chr3 = "";
            var enc1, enc2, enc3, enc4 = "";
            var i = 0;

            do {
                chr1 = eval('0x' + input.charAt(i++) + input.charAt(i++));
                if (i < input.length)
                    chr2 = eval('0x' + input.charAt(i++) + input.charAt(i++));
                else
                    i = i + 2;
                if (i < input.length)
                    chr3 = eval('0x' + input.charAt(i++) + input.charAt(i++));
                else
                    i = i + 2;

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (i == input.length + 4) {
                    enc3 = enc4 = 64;
                } else if (i == input.length + 2) {
                    enc4 = 64;
                }

                output = output +
                        keyStr.charAt(enc1) +
                        keyStr.charAt(enc2) +
                        keyStr.charAt(enc3) +
                        keyStr.charAt(enc4);
                chr1 = chr2 = chr3 = "";
                enc1 = enc2 = enc3 = enc4 = "";
            } while (i < input.length);

            return output;
        }


        function sha1Hash(msg)
        {
            // constants [4.2.1]
            var K = [0x5a827999, 0x6ed9eba1, 0x8f1bbcdc, 0xca62c1d6];

            // PREPROCESSING 

            msg += String.fromCharCode(0x80); // add trailing '1' bit to string [5.1.1]

            // convert string msg into 512-bit/16-integer blocks arrays of ints [5.2.1]
            var l = Math.ceil(msg.length / 4) + 2;  // long enough to contain msg plus 2-word length
            var N = Math.ceil(l / 16);              // in N 16-int blocks
            var M = new Array(N);
            for (var i = 0; i < N; i++) {
                M[i] = new Array(16);
                for (var j = 0; j < 16; j++) {  // encode 4 chars per integer, big-endian encoding
                    M[i][j] = (msg.charCodeAt(i * 64 + j * 4) << 24) | (msg.charCodeAt(i * 64 + j * 4 + 1) << 16) |
                            (msg.charCodeAt(i * 64 + j * 4 + 2) << 8) | (msg.charCodeAt(i * 64 + j * 4 + 3));
                }
            }
            // add length (in bits) into final pair of 32-bit integers (big-endian) [5.1.1]
            // note: most significant word would be ((len-1)*8 >>> 32, but since JS converts
            // bitwise-op args to 32 bits, we need to simulate this by arithmetic operators
            M[N - 1][14] = ((msg.length - 1) * 8) / Math.pow(2, 32);
            M[N - 1][14] = Math.floor(M[N - 1][14])
            M[N - 1][15] = ((msg.length - 1) * 8) & 0xffffffff;

            // set initial hash value [5.3.1]
            var H0 = 0x67452301;
            var H1 = 0xefcdab89;
            var H2 = 0x98badcfe;
            var H3 = 0x10325476;
            var H4 = 0xc3d2e1f0;

            // HASH COMPUTATION [6.1.2]

            var W = new Array(80);
            var a, b, c, d, e;
            for (var i = 0; i < N; i++) {

                // 1 - prepare message schedule 'W'
                for (var t = 0; t < 16; t++)
                    W[t] = M[i][t];
                for (var t = 16; t < 80; t++)
                    W[t] = ROTL(W[t - 3] ^ W[t - 8] ^ W[t - 14] ^ W[t - 16], 1);

                // 2 - initialise five working variables a, b, c, d, e with previous hash value
                a = H0;
                b = H1;
                c = H2;
                d = H3;
                e = H4;

                // 3 - main loop
                for (var t = 0; t < 80; t++) {
                    var s = Math.floor(t / 20); // seq for blocks of 'f' functions and 'K' constants
                    var T = (ROTL(a, 5) + f(s, b, c, d) + e + K[s] + W[t]) & 0xffffffff;
                    e = d;
                    d = c;
                    c = ROTL(b, 30);
                    b = a;
                    a = T;
                }

                // 4 - compute the new intermediate hash value
                H0 = (H0 + a) & 0xffffffff;  // note 'addition modulo 2^32'
                H1 = (H1 + b) & 0xffffffff;
                H2 = (H2 + c) & 0xffffffff;
                H3 = (H3 + d) & 0xffffffff;
                H4 = (H4 + e) & 0xffffffff;
            }

            return H0.toHexStr() + H1.toHexStr() + H2.toHexStr() + H3.toHexStr() + H4.toHexStr();
        }

        //
        // function 'f' [4.1.1]
        //
        function f(s, x, y, z)
        {
            switch (s) {
                case 0:
                    return (x & y) ^ (~x & z);
                case 1:
                    return x ^ y ^ z;
                case 2:
                    return (x & y) ^ (x & z) ^ (y & z);
                case 3:
                    return x ^ y ^ z;
            }
        }

        //
        // rotate left (circular left shift) value x by n positions [3.2.5]
        //
        function ROTL(x, n)
        {
            return (x << n) | (x >>> (32 - n));
        }

        //
        // extend Number class with a tailored hex-string method 
        //   (note toString(16) is implementation-dependant, and 
        //   in IE returns signed numbers when used on full words)
        //
        Number.prototype.toHexStr = function()
        {
            var s = "", v;
            for (var i = 7; i >= 0; i--) {
                v = (this >>> (i * 4)) & 0xf;
                s += v.toString(16);
            }
            return s;
        }
    </script>
    <?php echo $footer?>