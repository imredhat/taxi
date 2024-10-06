<?php
unset($css_files['b36caa4af5f8b40ecf114db81b79f9e5d11be22f']);
foreach ($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>









      <?php echo $output; ?>
 
    <?php foreach ($js_files as $file): ?>
      <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>


<style>
  div#options-content,#message-box,.alert ,.span12 {
    width: 70%;
    margin: auto;
    float: none;
  }
  table{
    border-radius: 10px !important;
  }


  .container-full {
    margin: 0;
    margin-left: 0;
    width: 100%;
    min-height: 100%;
    position: unset;
    top: sdf; 
    left: 0 !important;
    background: #f5f7fa;
    padding-top: none;
    z-index: 9999;
    -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    transition: all 1s ease;
    margin: auto;
    padding: 0;
    margin: 0 auto;
    direction: rtl;;
    }

    body,.table-section{
      background-color: var(--bs-body-bg);
    }

    .fa::before{
      font-family: FontAwesome;
    }
    

</style>

