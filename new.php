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
				'content'	=> $_POST['personEmail'],
				'href'		=> 'mailto:' . $_POST['personEmail'],
				'title'		=> 'Email ' . $_POST['personName']
			);
		}

		if (isset($_POST['personExt']) && $_POST['personExt']) {
			$person['ext'] = 'ext. ' . $_POST['personeExt'];
		}

		if (isset($_POST['personDirect']) && !empty($_POST['personDirect'])) {
			$person['direct'] = array(
				'href'			=> 'tel:+1' . $_POST['direct'],
				'title'			=> 'Call ' . $_POST['personName'] . ' directly.'
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
				'href'			=> 'tel:+1' . $_POST['direct'],
				'title'			=> 'Call ' . $_POST['personName'] . ' on mobile.'
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

		// Validate Required Data
		if (isset($person['name']) && isset($person['title']) && isset($person['email'])) {
			$validateRequired = true;
		}
		if ($validateRequired) {
			// Echo Signature
			?>
			PREVIEW
			
			<table id="signature" align='left' border='0' celpadding='0' celspacing='0' style='border-left: 2px solid #FF0000; font-family: sans-serif; color: #666666; font-size: 12px; border-collapse: collapse; border-spacing: 0; margin: 0; line-height: 1.2;' width='100%'>
			  <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
			    <td style='font-size: 14px; padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
			      <strong style='font-weight: bold'><?php echo $person['name']; ?> <span style="margin-left: 5px; margin-right: 5px;">|</span></strong> <?php echo $person['title']; ?>
			    </td>
			  </tr>
			  <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
			    <td style='padding-top: 0px; padding-bottom: 5px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
			      <a href='mailto:<?php echo $person['email']; ?>' style='text-decoration: none;' title='Email <?php echo $person['name']; ?>'>
			        <?php echo $person['email']; ?>
			      </a>
			    </td>
			  </tr>
			  <?php
				  if (isset($person['ext']) && !empty($person['ext'])) {
				  	?>
				  		<tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
						    <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
						      <strong style='font-weight: bold'>Main:</strong>
						      <a href='tel:+15555555555' style='text-decoration: none;' title="Call <?php echo $person['name']; ?>'s office">
						        (555) 555-5555 <?php echo $person['ext']; ?>
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
					      <a href='<?php echo $person['direct']['href']; ?>' style='text-decoration: none;' title='<?php echo $person['direct']['title']; ?>'>
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
					      <strong style='font-weight: bold'>Direct:</strong>
					      <a href='<?php echo $person['mobile']['href']; ?>' style='text-decoration: none;' title='<?php echo $person['mobile']['title']; ?>'>
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
			        <img alt='Logo for Roar Media' height='58' src='http://roarmedia.com/wp-content/themes/roarmedia/assets/img/roarmedia_email-logo.gif' style='display: block; border: none;' width='150'>
			      </a>
			    </td>
			  </tr>
			  <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
			    <td style='color: #666666; font-size: 14px; padding-top: 0px; padding-bottom: 5px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
			      <strong style='font-weight: bold'>An award-winning, digital-first, full-stack marketing agency</strong>
			    </td>
			  </tr>
			  <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
			    <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
			      <a href='https://goo.gl/maps/cXBoP4UFcEK9r32C8' style='text-decoration: none;' target='_blank' title='Find our offices on Google Maps'>
			        55 Miracle Mile, Suite 330, Coral Gables FL 33134
			      </a>
			    </td>
			  </tr>
			  <tr style='border-collapse: collapse; border-spacing: 0; margin: 0;'>
			    <td style='padding-top: 0px; padding-bottom: 2px; padding-left: 8px; border-collapse: collapse; border-spacing: 0; margin: 0;'>
			      <a href='https://roarmedia.com' style='text-decoration: none;' target='_blank' title='Go to: RoarMedia.com'>
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


			<?php
		} else {
			// Validation Failed

		}
		
	}

?>