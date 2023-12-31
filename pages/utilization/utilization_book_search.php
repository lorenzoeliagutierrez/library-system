<?php 
include "../../includes/session.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
  include "../../includes/header.php";
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
<?php 
include "../../includes/navbar.php";
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

<?php 
include "../../includes/sidebar.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-body">
              <div class="card-header">
                <h3 class="col-xs-6"><span class="fa fa-book"></span> MONTHLY LIBRARY RESOURCES UTILIZATION</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<hr>
 <ul class="nav navbar-right panel_toolbox">
                            <li class="col-xs-2">
                            <a href="utilization_book_print.php" target="_blank" style="background:none;">
                            <button name="print" type="submit" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
                            </a>
                            </li>
                        </ul>
                        
                        <div class="clearfix"></div>
                        <hr>
                        <form method="POST" class="form-inline">
                        
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo (isset($_POST['datefrom'])) ? $_POST['datefrom']: ''; ?>" name="datefrom" class="form-control has-feedback-left" placeholder="Date From" aria-describedby="inputSuccess2Status4">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo (isset($_POST['dateto'])) ? $_POST['dateto']: ''; ?>" name="dateto" class="form-control has-feedback-left" placeholder="Date To" aria-describedby="inputSuccess2Status4">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" name="search" class="btn btn-info"><i class="fa fa-calendar-o"></i> Search By Date Borrowed</button>
                                
                        </form><a style="float: right" href="utilization_record.php"><button class="btn btn-info"><i class="fa fa-reply"></i> All Reports <?php // echo $count_penalty['total']; ?></button></a>
                        <div class="clearfix"></div>
                        
                    </div>
                    <br>
                    <div class="x_content">
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
    <?php
        $_SESSION['datefrom'] = $_POST['datefrom'];
        $_SESSION['dateto'] = $_POST['dateto'];
    ?>
                            <?php
        $datefrom = $_POST['datefrom'];
        $dateto = $_POST['dateto'];
                            $return_query= mysqli_query($con,"SELECT * from borrow_book 
                            LEFT JOIN book ON borrow_book.book_id = book.book_id 
                            LEFT JOIN user ON borrow_book.user_id = user.user_id 
                            where borrow_book.date_borrowed BETWEEN '".$_POST['datefrom']." 00:00:01' and '".$_POST['dateto']." 23:59:59'
                            order by borrow_book.borrow_book_id DESC") or die (mysql_error());
                            $return_count = mysqli_num_rows($return_query);
                                
                            // $count_penalty = mysqli_query($con,"SELECT sum(book_penalty) FROM borrow_book 
                            // where borrow_book.date_returned BETWEEN '".$_POST['datefrom']." 00:00:01' and '".$_POST['dateto']." 23:59:59'  ")or die(mysql_error());
                            // $count_penalty_row = mysqli_fetch_array($count_penalty);
                            
                            ?>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                                
                        <span style="float:left;">
                    <?php 
                    // $count = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM `report` where report.date_transaction BETWEEN '$datefrom 00:00:01' and '$dateto 23:59:59' and report.detail_action like '%$status%'")) or die(mysql_error());
                    // $count1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM `report` WHERE `detail_action` = 'Borrowed Book'")) or die(mysql_error());
                    // $count2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM `report` WHERE `detail_action` = 'Returned Book'")) or die(mysql_error());
                    ?>
                            
                    <!---       <a href="borrowed_report.php"><button class="btn btn-success btn-outline"><i class="fa fa-info"></i> Borrowed Reports (<?php // echo  $count1['total']; ?>)</button></a>
                            <a href="returned_report.php"><button class="btn btn-danger btn-outline"><i class="fa fa-info"></i> Returned Reports (<?php // echo $count2['total']; ?>)</button></a>
                    -->
                        </span>
                            
                                </div>
                            <thead>
                                <tr>
                                    <th>Accession No./Barcode</th>
                                    <th>Borrower Name</th>
                                    <th><center>Title of Book / Author / Date</center></th>
                                <!---   <th>Author</th>
                                    <th>ISBN</th>   -->
                                    <th>Date Borrowed</th>
                                    <th>Date Returned</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                            while ($return_row= mysqli_fetch_array ($return_query) ){
                            $id=$return_row['borrow_book_id'];
?>
                            <tr>
                                <td><?php echo $return_row['accession_no']; ?></td>
                                <td style="text-transform: capitalize"><?php echo $return_row['firstname']." ".$return_row['lastname']; ?></td>
                                <td style="text-transform: capitalize"><?php echo $return_row['title'].' / '.$return_row['author'].' / '.$return_row['date_of_publ']; ?></td>
                            <!---   <td style="text-transform: capitalize"><?php // echo $return_row['author']; ?></td>
                                <td><?php // echo $return_row['isbn']; ?></td>  -->
                                <td><?php echo date("M d, Y h:m:s a",strtotime($return_row['date_borrowed'])); ?></td>
                                
                                <td><?php echo ($return_row['date_returned'] == "0000-00-00 00:00:00") ? "Pending" : date("M d, Y h:m:s a",strtotime($return_row['date_returned'])); ?></td>
                                <?php
                                    if ($return_row['borrowed_status'] != 'returned') {
                                        echo "<td class='alert alert-danger'>".$return_row['borrowed_status']."</td>";
                                    } else {
                                        echo "<td  class='alert alert-success'>".$return_row['borrowed_status']."</td>";
                                    }
                                ?>
                            </tr>
                            
                            <?php 
                            }
                            if ($return_count <= 0){
                                echo '
                                    <table style="float:right;">
                                        <tr>
                                            <td style="padding:10px;" class="alert alert-danger">No Books returned at this Date</td>
                                        </tr>
                                    </table>
                                ';
                            }                           
                            ?>
                            </tbody>
                            </table>
                        </div>
                            </div>
                        </div>
                        <!-- content starts here -->

                        
                        
                        <!-- content ends here -->


          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php 
include "../../includes/footer.php";
 ?>

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<?php
include "../../includes/script.php";
?>


</body>
</html>
