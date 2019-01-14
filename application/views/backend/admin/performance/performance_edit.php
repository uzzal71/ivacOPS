<div class="col-md-6 col-xs-12 col-md-offset-3">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Center Form</h2>
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
                    $performances = $this->db->get_where('performances', $where_data)->result_array();
                    foreach($performances as $row):
                    ?>
                    <form class="form-horizontal form-label-left" action="<?php echo site_url('performance_controller/update');?>" method="POST">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Receive</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="recive" value="<?php echo $row['recive'];?>">
                          <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        </div>
                      </div>
                      <div class="clearfix"></div><br />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="delivery" value="<?php echo $row['delivery'];?>">
                        </div>
                      </div>
                      <div class="clearfix"></div><br />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Backend</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="backend" value="<?php echo $row['backend'];?>">
                        </div>
                      </div>
                      <div class="clearfix"></div><br />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Scanning</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="scanning" value="<?php echo $row['scanning'];?>">
                        </div>
                      </div>
                      <div class="clearfix"></div><br />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" <?php echo ($row['status'] == '1') ? 'checked' : '' ;?> name="status" /> Active
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
                  <?php endforeach;?>
                  </div>
                </div>
              </div>