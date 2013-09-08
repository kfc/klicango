<?php
// $Id$

/**
 * @file
 * Default theme implementation to present an picture configured for the
 * user's account.
 *
 * Available variables:
 * - $account: Array of account information. Potentially unsafe. Be sure to
 *   check_plain() before use.
 */
?>
<?php
  foreach ($account->multipicture as $fid => $file) {
    if ($file->filepath != $account->picture) {
?>
  <div class="picture">
    <?php print theme('image', $file->filepath, t("@filename", array('@filename' => $file->filename)), t("@filename", array('@filename' => $file->filename))); ?>
  </div>
<?php
    }
  }
?>
