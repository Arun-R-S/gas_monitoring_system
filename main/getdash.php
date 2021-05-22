<?php
                    include 'db.php';
                    $conn = mysqli_connect($servername, $username, $password , $database);
                    $sql="SELECT * FROM user_info";
                    $result=$conn->query($sql);
                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc())
                        {
                          if($row['mail_confirm']==0)
                          {
                            $mail_status="Not Verified";
                            $mail_status_color="warning";
                          }
                          else
                          {
                            $mail_status="Verified";
                            $mail_status_color="success";
                          }
                          if($row['status']==0)
                          {
                            $profile_status="Pending";
                            $profile_status_color="warning";
                          }
                          else
                          {
                            $profile_status="Completed";
                            $profile_status_color="success";
                          }
                          if($row['allowing']=="YES")
                          {
                            $user_status="Active";
                            $user_status_color="success";
                          }
                          else
                          {
                            $user_status="Blocked";
                            $user_status_color="red";
                          }
                          $dt1 = new DateTime($row['created']);
                          $dt2 = new DateTime($row['last_updated']);
                          if($row['gender']=="")
                          {
                            $row['gender']="new";
                          }
                          echo "
                  
                  <tr>
                    <th scope='row'>
                      <div class='media align-items-center'>
                        <div class='avatar rounded-circle mr-3'>
                          <img alt='Image placeholder' src='../assets/img/theme/".$row['gender'].".jpg'>
                        </div><a href='adminupdate.php?userid=".$row['user_id']."' target='_blank'>
                        <div class='media-body'>
                        
                          <span class='name mb-0 text-sm'>".$row['firstname']." ".$row['lastname']."</span>
                          <h6>".$row['email']."</h6>
                          
                        </div></a>
                      </div>
                    </th>
                    <td >
                      <span class='badge badge-dot mr-4'>
                        <i class='bg-".$mail_status_color."'></i>
                        <span class='status'>".$mail_status."</span>
                      </span>
                    </td>
                    <td>
                      <span class='badge badge-dot mr-4'>
                        <i class='bg-".$profile_status_color."'></i>
                        <span class='status'>".$profile_status."</span>
                      </span>
                    </td>
                    <td>
                      <span class='badge badge-dot mr-4'>
                        <i class='bg-".$user_status_color."'></i>
                        <span class='status'>".$user_status."</span>
                      </span>
                    </td>
                    <td>
                      <div class='d-flex align-items-center'>
                        <span class='completion mr-2'>".$dt1->format('d-M-Y')."</span>
                      </div>
                      <div class='d-flex align-items-center'>
                        <span class='completion mr-2'>".$dt1->format('h:i:s A')."</span>
                      </div>
                    </td>
                    <td class='text-right'>
                      <div class='d-flex align-items-center'>
                        <span class='completion mr-2'>".$dt2->format('d-M-Y')."</span>
                      </div>
                      <div class='d-flex align-items-center'>
                        <span class='completion mr-2'>".$dt2->format('h:i:s A')."</span>
                      </div>
                    </td>
                  </tr>
             
                          ";
                        }
                    }
                    ?>