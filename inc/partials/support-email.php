<?php ob_start() ?>
<head>
<style>
  @font-face {
      font-family: 'bsans';
      src: url('http://podryad.flake.ink/wp-content/themes/fstore/fonts/o-regular.eot');
      src: url('http://podryad.flake.ink/wp-content/themes/fstore/fonts/o-regular.eot?#iefix') format('embedded-opentype'),
      url('http://podryad.flake.ink/wp-content/themes/fstore/fonts/o-regular.woff2') format('woff2'),
      url('http://podryad.flake.ink/wp-content/themes/fstore/fonts/o-regular.woff') format('woff'),
      url('http://podryad.flake.ink/wp-content/themes/fstore/fonts/o-regular.svg#o-regular') format('svg');
      font-weight: 400;
      font-style: normal;
      font-stretch: normal;
      unicode-range: U+0020-04D9;
  }

  body {
    font-family: 'bsans',sans-serif;
  }
</style>
<link rel="stylesheet" href="http://podryad.flake.ink/wp-content/themes/fstore/css/fonts.css" />
</head>
<body>
    <!--[if mso]>
    <style type="text/css">
    body, table, td {font-family: 'bsans', sans-serif !important;}
    </style>
    <![endif]-->
    <article id="box" style="max-width: 662px;border-radius: 4px;box-shadow: 0 0 26px 0 rgba(0, 0, 0, 0.07);padding: 40px;font-family: 'beau-sans','beau sans',sans-serif;color: #414042;box-sizing: border-box;">
        <h3 style="margin: 0 0 38px;font-weight: 400;font-size: 18px;"><?php echo $subj ?></h3>
        <span id="date" style="font-size: 14px;margin-right: 28px;"><?php echo $date ?></span>
        <span id="time" style="font-size: 14px;margin-right: 28px;">
            <img src="data:image/png;base64,<?php echo $icon ?>">
            <?php echo current_time('H:i') ?>
        </span>
        <div class="details" style="margin: 32px 0;">
          <span style="display: block;font-size: 14px;line-height: 1.5;color: #3f419a;text-decoration: none;"><?php echo $name ?></span>
          <a href="tel:<?php echo $phone ?>" style="display: block;font-size: 14px;line-height: 1.5;color: #3f419a;text-decoration: none;"><?php echo $phone ?></a>
          <a href="mailto:<?php echo $email ?>" style="display: block;font-size: 14px;line-height: 1.5;color: #3f419a;text-decoration: none;"><?php echo $email ?></a>
        </div>
        <p id="message" style="font-size: 14px;line-height: 1.5;">
          <?php echo nl2br($msg) ?>
        </p>
    </article>
</body>

<?php $body = ob_get_clean(); ?>
