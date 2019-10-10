<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- FontAwesome 4.7 -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Roar Media Email Signature Generator</title>
  </head>
  <body>
    <?php
        if ('submit' === $_POST['submit']) {
            $person = array();

            if (isset($_POST['personName']) && !empty($_POST['personName'])) {
                $person['name'] = $_POST['personName'];
            }

            if (isset($_POST['personTitle']) && !empty($_POST['personTitle'])) {
                $person['title'] = $_POST['personTitle'];
            }

            if (isset($_POST['personEmail']) && !empty($_POST['personEmail'])) {
                $person['email'] = array(
                    'content'   => $_POST['personEmail'],
                    'href'      => 'mailto:' . $_POST['personEmail'],
                    'title'     => 'Email ' . $_POST['personName']
                );
            }

            if (isset($_POST['personExt']) && $_POST['personExt']) {
                $person['ext'] = 'ext. ' . $_POST['personExt'];
            }

            if (isset($_POST['personDirect']) && !empty($_POST['personDirect'])) {
                $person['direct'] = array(
                    'href'          => 'tel:+1' . $_POST['direct'],
                    'title'         => 'Call ' . $_POST['personName'] . ' directly.'
                );
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
                $person['direct']['content'] = $reformatTel;
            }

            if (isset($_POST['personMobile']) && !empty($_POST['personMobile'])) {
                $person['mobile'] = array(
                    'href'          => 'tel:+1' . $_POST['direct'],
                    'title'         => 'Call ' . $_POST['personName'] . ' on mobile.'
                );
                $telArray = str_split($_POST['personMobile']);
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
                $person['mobile']['content'] = $reformatTel;
            }
        }
        if (isset($person['name']) && isset($person['title']) && isset($person['email'])) {
            $validateRequired = true;
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
    			<input type="text" class="form-control" id="personName" name="personName" placeholder="ex. John Lion" <?php if (!empty($_POST['personName'])) { echo 'value="'.$_POST['personName'].'"'; } ?> required>
    		</div>
    		<div class="form-group">
    			<label for="personTitle">Enter Person's Title</label>
    			<input type="text" class="form-control" id="personTitle" name="personTitle" placeholder="ex. Chief Fake Employee" <?php if (!empty($_POST['personTitle'])) { echo 'value="'.$_POST['personTitle'].'"'; } ?>  required>
    		</div>
    		<div class="form-group">
    			<label for="personEmail">Enter Person's Email</label>
    			<input type="email" class="form-control" id="personEmail" name="personEmail" placeholder="ex. jlion@roarmedia.com" <?php if (!empty($_POST['personEmail'])) { echo 'value="'.$_POST['personEmail'].'"'; } ?>  required>
    		</div>
    		<div class="form-group">
    			<label for="personDirect">Enter Person's Direct Line</label>
    			<input type="tel" class="form-control" id="personDirect" name="personDirect" placeholder="ex. 5555555555" pattern="[0-9]{10}" <?php if (!empty($_POST['personDirect'])) { echo 'value="'.$_POST['personDirect'].'"'; } ?> >
                <small id="directHelp" class="form-text text-muted"><strong class="text-uppercase text-danger">Input numbers only</strong> (optional)</small>
    		</div>
    		<div class="form-group">
    			<label for="personExt">Enter Person's Direct Extension</label>
    			<input type="text" class="form-control" id="personExt" name="personExt" placeholder="ex. 000" <?php if (!empty($_POST['personExt'])) { echo 'value="'.$_POST['personExt'].'"'; } ?> >
                <small id="extHelp" class="form-text text-muted">(optional)</small>
    		</div>
            <div class="form-group">
                <label for="personMobile">Enter Person's Mobile</label>
                <input type="tel" class="form-control" id="personMobile" name="personMobile" placeholder="ex. 5555555555" pattern="[0-9]{10}" <?php if (!empty($_POST['personMobile'])) { echo 'value="'.$_POST['personMobile'].'"'; } ?> >
                <small id="mobileHelp" class="form-text text-muted"><strong class="text-uppercase text-danger">Input numbers only</strong> (optional)</small>
            </div>
    		<div class="form-group">
    			<button class="btn btn-primary" type="submit" name="submit" value="submit">Generate</button>
    		</div>
    	</form>
    </section>

<?php if ($_POST['submit'] === 'submit' && $validateRequired): ?>
    <section class="container pb-5" style="max-width: 540px;">
        <h2>Results</h2>
        <p>
            Click the <strong>select signature</strong> button below to highlight the nessary content, then copy (Ctrl/Cmd + C) the content and paste it into the signature area in <a href="https://support.google.com/mail/answer/8395?co=GENIE.Platform%3DDesktop&hl=en" target="_blank" rel="noopener nofollow" title="Learn how to update your signature in Gmail" data-toggle="tooltip" data-placement="top">Gmail <i class="fa fa-external-link" aria-hidden="true"></i></a>, <a href="https://support.office.com/en-us/article/change-an-email-signature-86597769-e4df-4320-b219-39d6e1a9e87b" target="_blank" rel="noopener nofollow" title="Learn how to update your signature in Outlook" data-toggle="tooltip" data-placement="top">Outlook <i class="fa fa-external-link" aria-hidden="true"></i></a>, or <a href="https://support.apple.com/guide/mail/create-and-use-email-signatures-mail11943/mac" target="_blank" rel="noopener nofollow" title="Learn how to update your signature in Apple Mail" data-toggle="tooltip" data-placement="top">Apple Mail <i class="fa fa-external-link" aria-hidden="true"></i></a>.
        </p>
        <hr>
        <h3>Render</h3>
        <div class="py-4">
            <?php //echo $results; ?>
            <table id="signature" align='left' border='0' celpadding='0' celspacing='0' style='border-left: 2px solid #FF0000; font-family: Arial, Helvetica, sans-serif; color: #000000; font-size: 12px; border-collapse: collapse; border-spacing: 0; margin: 0; line-height: 1.2;' width='100%'>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='font-size: 14px; padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                  <strong style='font-weight: bold'><?php echo $person['name']; ?> <span style="margin-left: 5px; margin-right: 5px;">|</span></strong> <?php echo $person['title']; ?>
                </td>
              </tr>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='padding-top: 0px; padding-bottom: 5px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                  <a href='mailto:<?php echo $person['email']['href']; ?>' style='color: #007bff; text-decoration: none;' title='<?php echo $person['email']['title']; ?>'>
                    <?php echo $person['email']['content']; ?>
                  </a>
                </td>
              </tr>
              <?php
                  if (isset($person['ext']) && !empty($person['ext'])) {
                    ?>
                        <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                            <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                              <strong style='font-weight: bold'>Main:</strong>
                              <a href='tel:+13054032080' style='color: #007bff; text-decoration: none;' title="Call <?php echo $person['name']; ?>'s office">
                                (305) 403-2080 <?php echo $person['ext']; ?>
                              </a>
                            </td>
                          </tr>
                    <?php
                  }
              ?>
              <?php
                  if (isset($person['direct']) && !empty($person['direct'])) {
                    ?>
                      <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                        <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                          <strong style='font-weight: bold'>Direct:</strong>
                          <a href='<?php echo $person['direct']['href']; ?>' style='color: #007bff; text-decoration: none;' title='<?php echo $person['direct']['title']; ?>'>
                            <?php echo $person['direct']['content']; ?>
                          </a>
                        </td>
                      </tr>
                    <?php
                  }
              ?>
              <?php
                  if (isset($person['mobile']) && !empty($person['mobile'])) {
                    ?>
                      <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                        <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                          <strong style='font-weight: bold'>Mobile:</strong>
                          <a href='<?php echo $person['mobile']['href']; ?>' style='color: #007bff; text-decoration: none;' title='<?php echo $person['mobile']['title']; ?>'>
                            <?php echo $person['mobile']['content']; ?>
                          </a>
                        </td>
                      </tr>
                    <?php
                  }
              ?>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                  <a href='https://roarmedia.com' style='text-decoration: none;' target='_blank' title='Go to: RoarMedia.com'>
                    <img alt='Logo for Roar Media' height='70' src='http://roarmedia.com/wp-content/themes/roarmedia/assets/img/roarmedia_email-logo-10year.gif' style='display: block; border: none;' width='250'>
                  </a>
                </td>
              </tr>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='color: #000000; font-size: 14px; padding-top: 0px; padding-bottom: 5px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                  <strong style='font-weight: bold'>An award-winning, digital-first, full-stack marketing agency</strong>
                </td>
              </tr>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                  <a href='https://goo.gl/maps/cXBoP4UFcEK9r32C8' style='color: #007bff; text-decoration: none;' target='_blank' title='Find our offices on Google Maps'>
                    55 Miracle Mile, Suite 330, Coral Gables, FL 33134
                  </a>
                </td>
              </tr>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                  <a href='https://roarmedia.com' style='color: #007bff; text-decoration: none;' target='_blank' title='Go to: RoarMedia.com'>
                    RoarMedia.com
                  </a>
                </td>
              </tr>
              <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                <td style='padding-top: 5px; padding-bottom: 0px; padding-left: 8px;'>
                  <table align='left' border='0' celpadding='0' celspacing='0' style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                    <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                      <td align='left' style='padding-right: 5px;  border-collapse: collapse; border-spacing: 0; margin: 0;'>
                        <a href='https://www.facebook.com/roarmedia11/' title='Visit our Facebook'>
                          <img alt='' height='24' src='https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-facebook.png' style='border: none;' width='24'>
                        </a>
                      </td>
                      <td align='left' style='padding-right: 5px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                        <a href='https://twitter.com/roarmedia' title='Visit our Twitter'>
                          <img alt='' height='24' src='https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-twitter.png' style='border: none;' width='24'>
                        </a>
                      </td>
                      <td align='left' style='padding-right: 5px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
                        <a href='https://www.instagram.com/roarmedia' title='Visit our Instagram'>
                          <img alt='' height='24' src='https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-instagram.png' style='border: none;' width='24'>
                        </a>
                      </td>
                      <td align='left' style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
                        <a href='https://www.linkedin.com/company/roarmedia/' title='Visit our LinkedIn'>
                          <img alt='' height='24' src='https://roarmedia.com/wp-content/uploads/2019/09/rmemailico-linkedin.png' style='border: none;' width='24'>
                        </a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
        </div>
        <div class="clearfix"></div>
        <hr>
        <button id="viscopy" class="btn btn-primary">Select Signature</button>
    </section>
<?php endif; ?>
    <footer class="container mt-4" style="max-width: 540px">
        <p class="text-center text-muted"><small>This is all <a target="_blank" href="mailto:kwilliams@roarmedia.com?subject=Re: Signature Generator">Kris'</a> fault. <?php if ($validateRequired) { echo '<a href="#" id="partymode" data-toggle="tooltip" data-placement="top" title="Might crash your browser if it can\'t hang">🎉</a>'; } ?></small></p>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).html()).select();
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

        if ($('#viscopy').length) {
            const clickable = document.getElementById('viscopy');
            clickable.addEventListener('click', () => selectText('signature'));
        }

        $('#codecopy').click(function(e) {
            copyToClipboard('#code');
        });
        var partyMode = false;
        var runPartyMode;
        $('#partymode').click(function() {
            if (partyMode === true) {
                clearInterval(runPartyMode);
            } else {
                runPartyMode = setInterval(function() {
                    $('body *:not(.container)').each(function() {
                        $(this).css({
                            color: '#' + Math.floor(Math.random()*16777215).toString(16),
                            backgroundColor: '#' + Math.floor(Math.random()*16777215).toString(16),
                            borderColor: '#' + Math.floor(Math.random()*16777215).toString(16),
                            transition: 'all 500ms linear',
                            fontSize: Math.random() + 1 + 'em',
                            transform: 'rotateX('+Math.floor(Math.random() * 360 + 1)+'deg) rotateY('+Math.floor(Math.random() * 360 + 1)+'deg) rotateZ('+Math.floor(Math.random() * 360 + 1)+'deg)'
                        })
                    });
                    $('img').css({
                        filter: 'hue-rotate('+Math.floor(Math.random() * 360) + 1+'deg)',
                    })
                    $('body').css({
                        backgroundColor: '#' + Math.floor(Math.random()*16777215).toString(16),
                        transition: 'all 500ms linear'
                    });
                }, 500);
            }
        });
    </script>
  </body>
</html>