<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-unit').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-unit">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php if ($sort == 'unit_id') { ?>
                    <a href="<?php echo $sort_unit_id; ?>" class="<?php echo strtolower($order); ?>">ID</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_unit_id; ?>">ID</a>
                  <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'code') { ?>
                    <a href="<?php echo $sort_code; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_code; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_code; ?>"><?php echo $column_code; ?></a>
                  <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'title') { ?>
                    <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'symbol_rus') { ?>
                    <a href="<?php echo $sort_symbol_rus; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_symbol_rus; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_symbol_rus; ?>"><?php echo $column_symbol_rus; ?></a>
                  <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'symbol_ukr') { ?>
                      <a href="<?php echo $sort_symbol_ukr; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_symbol_ukr; ?></a>
                      <?php } else { ?>
                      <a href="<?php echo $sort_symbol_ukr; ?>"><?php echo $column_symbol_ukr; ?></a>
                      <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'symbol_intl') { ?>
                    <a href="<?php echo $sort_symbol_intl; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_symbol_intl; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_symbol_intl; ?>"><?php echo $column_symbol_intl; ?></a>
                  <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($units) { ?>
                <?php foreach ($units as $unit) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($unit['unit_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $unit['unit_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $unit['unit_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-right"><?php echo $unit['unit_id']; ?></td>
                  <td class="text-right"><?php echo $unit['code']; ?></td>
                  <td class="text-left"><?php echo $unit['title']; ?></td>
                  <td class="text-left"><?php echo $unit['symbol_rus']; ?></td>
                  <td class="text-left"><?php echo $unit['symbol_ukr']; ?></td>
                  <td class="text-left"><?php echo $unit['symbol_intl']; ?></td>
                  <td class="text-right"><a href="<?php echo $unit['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>