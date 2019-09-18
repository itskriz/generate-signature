<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Roar Media Email Signature Generator</title>
  </head>
  <body>
    <?php

    $results = '';

    $fields = array(
        'personName', 'personTitle', 'personEmail', 'personDirect', 'personExt'
    );
    $sig_format = '<table id="signature" align="left" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; line-height: 1.3" width="460"> <tbody> <tr> <td align="left" style="font-size: 14px; font-weight: bold;"> %1$s | %2$s </td></tr><tr> <td align="left"> <a href="mailto:%3$s" title="Email %1$s" style="color: #0000FF;"><span style="color: #0000FF;">%3$s</span></a> </td></tr><tr> <td align="left"> <strong>Main:</strong> <a title="Call our offices" href="tel:+13054032080" style="color: #0000FF;"><span style="color: #0000FF;">(305) 403-2080</span></a>%4$s </td></tr>%5$s<tr> <td align="left" style="padding-top: 13px; padding-bottom: 10px;"> <a href="http://roarmedia.com" target="_blank"><img style="border: none !important;" src="https://roarmedia.com/wp-content/uploads/2019/03/roarmedia_web-logo_stacked.png" alt="Logo for Roar Media" width="200"></a> </td></tr><tr> <td align="left" style="color: #FF0000; font-size: 14px; font-weight: bold;"> An award-winning, digital-first, full-stack marketing agency </td></tr><tr> <td align="left"> 55 Miracle Mile, Suite 330, Coral Gables FL 33134 </td></tr><tr> <td align="left"> <a href="http://roarmedia.com" title="Go to: RoarMedia.com" target="_blank" style="color: blue"><span style="color: blue;">RoarMedia.com</span></a> </td></tr><tr> <td align="left" style="padding-top: 13px; padding-bottom: 13px;"> <table align="left" border="0" cellpadding="0" cellspacing="0" width=""> <tr> <td align="left" style="padding-right: 10px;"> <a href="https://www.facebook.com/roarmedia11/" title="Follow us on Facebook" target="_blank"> <img style="border: none !important;" src="https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-facebook.png" alt="Follow us on Facebook" width="26"> </a> </td><td align="left" style="padding-right: 10px;"> <a href="https://twitter.com/roarmedia" title="Follow us on Twitter" target="_blank"> <img style="border: none !important;" src="https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-twitter.png" alt="Follow us on Twitter" width="26"> </a> </td><td align="left" style="padding-right: 10px;"> <a href="https://www.instagram.com/roarmedia" title="Follow us on Instagram" target="_blank"> <img style="border: none !important;" src="https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-instagram.png" alt="Follow us on Instagram" width="26"> </a> </td><td align="left"> <a href="https://www.linkedin.com/company/roarmedia/" target="_blank" title="Follow us on LinkedIn"> <img style="border: none !important;" src="https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-linkedin.png" alt="Follow us on LinkedIn" width="26"> </a> </td></tr></table> </td></tr></tbody></table>';

    if ($_POST['submit'] === 'submit') {
        

        $personName = '';
        $personTitle = '';
        $personEmail = '';
        $personDirect = '';
        $personExt = '';

        if (isset($_POST['personName']) && !empty($_POST['personName']) ) {
            $personName = $_POST['personName'];
        }

        if (isset($_POST['personExt']) && !empty($_POST['personExt']) ) {
            $personExt = ' Ext. ' . $_POST['personExt'];
        }
        if (isset($_POST['personDirect']) && !empty($_POST['personDirect'])) {
            $directFormat = '<tr> <td align="left"> <strong>Direct:</strong> <a title="Call '.$personName.' directly" href="tel:+1%1$s" style="color: #0000FF;"><span style="color: #0000FF;">%2$s</span></a> </td></tr>';
            $telArray = str_split($_POST['personDirect']);
            $reformatTel = '(';
            for ($i = 0; $i < count($telArray); $i++) {
                $reformatTel .= $telArray[$i];
                if (2 == $i) {
                    $reformatTel .= ') ';
                }
                if (5 == $i) {
                    $reformatTel .= '-';
                }
            }
            $personDirect = sprintf(
                $directFormat,
                $_POST['personDirect'],
                $reformatTel
            );
        }

        $results = sprintf(
            $sig_format,
            $_POST['personName'],
            $_POST['personTitle'],
            $_POST['personEmail'],
            $personExt,
            $personDirect
        );

    }

    ?>
    <section class="container my-5" style="max-width: 540px;">
    	<h1>
    		Roar Media Signature Builder
    	</h1>
    	<hr>
    	<form action="/generate-signature/index.php" id="builder" style="margin: 0 auto;" method="post" enctype="multipart/form-data">
    		<div class="form-group">
    			<label for="personName">Enter Person's Name</label>
    			<input type="text" class="form-control" id="personName" name="personName" placeholder="John Lion" <?php if (!empty($_POST['personName'])) { echo 'value="'.$_POST['personName'].'"'; } ?> required>
    		</div>
    		<div class="form-group">
    			<label for="personTitle">Enter Person's Title</label>
    			<input type="text" class="form-control" id="personTitle" name="personTitle" placeholder="Chief Fake Employee" <?php if (!empty($_POST['personTitle'])) { echo 'value="'.$_POST['personTitle'].'"'; } ?>  required>
    		</div>
    		<div class="form-group">
    			<label for="personEmail">Enter Person's Email</label>
    			<input type="email" class="form-control" id="personEmail" name="personEmail" placeholder="jlion@roarmedia.com" <?php if (!empty($_POST['personEmail'])) { echo 'value="'.$_POST['personEmail'].'"'; } ?>  required>
    		</div>
    		<div class="form-group">
    			<label for="personDirect">Enter Person's Direct Line</label>
    			<input type="tel" class="form-control" id="personDirect" name="personDirect" placeholder="5555555555" pattern="[0-9]{10}" <?php if (!empty($_POST['personDirect'])) { echo 'value="'.$_POST['personDirect'].'"'; } ?> >
                <small id="directHelp" class="form-text text-muted"><strong class="text-uppercase">Input numbers only</strong> (optional)</small>
    		</div>
    		<div class="form-group">
    			<label for="personExt">Enter Person's Direct Extension</label>
    			<input type="text" class="form-control" id="personExt" name="personExt" placeholder="000" <?php if (!empty($_POST['personExt'])) { echo 'value="'.$_POST['personExt'].'"'; } ?> >
                <small id="extHelp" class="form-text text-muted">(optional)</small>
    		</div>
    		<div class="form-group">
    			<button class="btn btn-primary" type="submit" name="submit" value="submit">Generate</button>
    		</div>
    	</form>
    </section>

<?php if ($_POST['submit'] === 'submit'): ?>
    <section class="container pb-5" style="max-width: 540px;">
        <h2>Results</h2>
        <p>
            Click the <strong>select signature</strong> button below to highlight the nessary content, then copy (Ctrl/Cmd + C) the content and paste it into the signature area in G-Mail.
        </p>
        <hr>
        <h3>Preview</h3>
        <div class="py-4">
            <?php echo $results; ?>
        </div>
        <div class="clearfix"></div>
        <button id="viscopy" class="btn btn-primary">Select Signature</button>
        <hr>
        <h3>Code</h3>
        <code id="code" class="px-2 pb-2 bg-dark text-light mb-2" style="width: 100%; display: block; min-height: 300px; font-size: 10px; font-family: monospace;">
            <?php echo htmlspecialchars($results);?>
        </code>
        <button id="codecopy" class="btn btn-primary">Copy Code</button>
    </section>
    <footer class="container mt-4" style="max-width: 540px">
        <p class="text-center text-muted"><small>This is all <a href="mailto:kwilliams@roarmedia.com?subject=Signature Generator">Kris'</a> fault.</small></p>
    </footer>
<?php endif; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }

        function selectText(node) {
            node = document.getElementById(node);

            if (document.body.createTextRange) {
                const range = document.body.createTextRange();
                range.moveToElementText(node);
                range.select();
            } else if (window.getSelection) {
                const selection = window.getSelection();
                const range = document.createRange();
                range.selectNodeContents(node);
                selection.removeAllRanges();
                selection.addRange(range);
            } else {
                console.warn("Could not select text in node: Unsupported browser.");
            }
        }

        const clickable = document.getElementById('viscopy');
        clickable.addEventListener('click', () => selectText('signature'));

        $('#codecopy').click(function(e) {
            copyToClipboard('#code');
        });
    </script>
  </body>
</html>