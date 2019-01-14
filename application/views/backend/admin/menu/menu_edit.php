<div class="col-md-6 col-xs-12 col-md-offset-3">
<div class="x_panel">
  <div class="x_title">
    <h2>Edit Menu Form</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Settings 1</a>
          </li>
          <li><a href="#">Settings 2</a>
          </li>
        </ul>
      </li>
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br />
    <?php
    $where_data = array('id' => $id);
    $specific_menu = $this->db->get_where('menus', $where_data)->result_array();
    foreach($specific_menu as $row_menu):
    ?>
    <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('menu_controller/update/'.$id);?>" method="POST">
       <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="menu" value="<?php echo $row_menu['menu'];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent/Parent Name</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
         <select class="form-control" required name="parent_id" value="<?php echo $each_user_role->parent_id?>" class="form-control col-sm-6 custom-input" id="parent_id">
          <option value="select">select</option>
          <option <?php if($each_user_role->parent_id == '0'){echo 'selected = "selected"';} ?> value="0">Self Parent</option>
        <?php foreach($all_role as $each_role){?>
          <option <?php if($each_user_role->parent_id == $each_role->id){echo 'selected = "selected"';} ?> value="<?php echo $each_role->id?>"><?php echo $each_role->menu?></option>
        <?php }?>
        </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Url Link</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="url_link" value="<?php echo $row_menu['url_link'];?>">
        </div>
      </div>
      <div class="clearfix"></div><br />
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="">
            <label>
              <input type="checkbox" class="js-switch" <?php echo ($row_menu['status'] == '1') ? 'checked' : '';?> name="status" />
            </label>
          </div>
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary">Cancel</button>
          <button type="reset" class="btn btn-primary">Reset</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>

    </form>
  <?php endforeach ;?>
  </div>
</div>
</div>