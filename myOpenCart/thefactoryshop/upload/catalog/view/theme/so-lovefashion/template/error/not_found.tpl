<?php echo $header; ?>
<?php global $config; ?>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">
      <?php //echo $column_left; ?>
      <?php if ($column_left && $column_right) { ?>
      <?php $class = 'col-sm-6'; ?>
      <?php } elseif ($column_left || $column_right) { ?>
      <?php $class = 'col-sm-9'; ?>
      <?php } else { ?>
      <?php $class = 'container'; ?>
      <?php } ?>
      <div id="content" class="container error-page">
          <p class="top-text"><?php echo $text_error; ?></p>
      </div>

    </div>


</div>
<?php echo $footer; ?>

<script>
function goBack() {
     window.history.back()
}
</script>