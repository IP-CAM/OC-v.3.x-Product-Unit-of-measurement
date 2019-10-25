<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-unit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>  
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-unit" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-4 control-label" for="input-top"><?php echo $entry_default; ?></label>
            <div class="col-sm-8">
              <div class="checkbox">
                <label>
                  <?php if ($default) { ?>
                  <input type="checkbox" name="default" value="1" checked="checked" id="input-top" />
                  <?php } else { ?>
                  <input type="checkbox" name="default" value="1" id="input-top" />
                  <?php } ?>
                  &nbsp; </label>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-4 control-label" for="input-code"><?php echo $entry_code; ?></label>
            <div class="col-sm-8">
              <input type="text" name="code" value="<?php echo $code; ?>" placeholder="<?php echo $entry_code; ?>" id="input-code" class="form-control" />
              <?php if ($error_code) { ?>
              <div class="text-danger"><?php echo $error_code; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-4 control-label" for="input-title"><?php echo $entry_title; ?></label>
            <div class="col-sm-8">
              <input type="text" name="title" value="<?php echo $title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control" />
              <?php if ($error_title) { ?>
              <div class="text-danger"><?php echo $error_title; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="input-symbol-rus"><?php echo $entry_symbol_rus; ?></label>
            <div class="col-sm-8">
              <input type="text" name="symbol_rus" value="<?php echo $symbol_rus; ?>" placeholder="<?php echo $entry_symbol_rus; ?>" id="input-symbol-rus" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="input-symbol-ukr"><?php echo $entry_symbol_ukr; ?></label>
            <div class="col-sm-8">
              <input type="text" name="symbol_ukr" value="<?php echo $symbol_ukr; ?>" placeholder="<?php echo $entry_symbol_ukr; ?>" id="input-symbol-ukr" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="input-symbol-intl"><?php echo $entry_symbol_intl; ?></label>
            <div class="col-sm-8">
              <input type="text" name="symbol_intl" value="<?php echo $symbol_intl; ?>" placeholder="<?php echo $entry_symbol_intl; ?>" id="input-symbol-intl" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="input-symbol-letter-intl"><?php echo $entry_symbol_letter_intl; ?></label>
            <div class="col-sm-8">
              <input type="text" name="symbol_letter_intl" value="<?php echo $symbol_letter_intl; ?>" placeholder="<?php echo $entry_symbol_letter_intl; ?>" id="input-symbol-letter-intl" class="form-control" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>