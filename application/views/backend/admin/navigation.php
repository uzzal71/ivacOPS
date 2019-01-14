<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!-- <h3>General</h3> -->
                <ul class="nav side-menu">


                  <?php

                    include('manual_db_connect.php');

                    $GLOBALS['permitted_actions'] = explode(",", $_SESSION['menu_permitted']);
                    
                    generate_menu(0, $mysqli);      
                    
                    function generate_menu($parent_id, $mysqli)
                    {
                      $sql = "SELECT
                            a.id,
                            a.menu,
                            a.url_link,
                            (SELECT count(*) FROM menus b WHERE a.id = b.parent_id) AS no_of_child
                          FROM
                            menus a
                          WHERE parent_id = ".$parent_id." 
                            AND id IN (".$_SESSION['menu_permitted'].")";


                            //var_dump($sql);exit();
                      
                      if (!$result = $mysqli->query($sql))
                      {
                        echo "Error: Our query failed to execute and here is why: \n Query: " . $sql . "\n Errno: " . $mysqli->errno . "\n Error: " . $mysqli->error . "\n";
                        exit;
                      }
                      else if ($result->num_rows > 0)
                      {             
                        while ($each_role = $result->fetch_assoc())
                        {               
                          
                          if($parent_id == 0)
                          {
                            echo "<li>
                                  <a><i class='fa fa-circle'></i> ".$each_role['menu']." <span class='fa fa-chevron-down'></span></a>";
                              
                              
                              if($each_role['no_of_child'] > 0)
                              {
                                echo '<ul class="nav child_menu">';
                              }
                          }
                          else
                          {                 
                            if($each_role['no_of_child'] > 0)
                            {
                              echo "<li><a><i class=''></i> ".$each_role['menu']." <span class='fa fa-chevron-down'></span></a>
                                  <ul class='nav child_menu'>
                                ";
                                // this is multiple dropdown ex: report->>manin->>more
                            }
                            else
                            {
                              echo "<li><a href=".site_url().$each_role['url_link']."><i class=''></i> ".$each_role['menu']."</a></li>";
                              // normali this
                            }
                            
                          }
                          
                          generate_menu($each_role['id'], $mysqli);
                          
                          if($each_role['no_of_child'] > 0)
                          {
                            echo "</ul>";
                          }
                          
                          echo "</li>";
                          
                        }
                      }
                    }
                  
                  
                  ?>



                </ul>
              </div>
            </div>