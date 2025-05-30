<?php include('include/head.php'); ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<?php
error_reporting(0);
require_once('../assets/constants/config.php');
require_once('../assets/constants/check-login.php');
require_once('../assets/constants/fetch-my-info.php');

$stmt = $conn->prepare("SELECT * FROM borrow WHERE id=? and delete_status='0'");
$stmt->execute([$_POST['id']]);
$result = $stmt->fetch();
?>

<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Edit Borrow</h5>
                    <div class="card-body">
                        <form class="form-horizontal" action="Operation/borrow.php" method="post" enctype="multipart/form-data" id="add_brand">
                            <input type="hidden" name="id" value="<?php echo $result['id'];?>">
                            <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Name</label>
                                        <select class="form-control" name="name" required>
                                            <option value="">Select Name</option>
                                            <?php $stmt = $conn->prepare("SELECT * FROM `admin` WHERE delete_status='0' AND admin_user!='1'");
                      $stmt->execute();
                      $record = $stmt->fetchAll();

                      foreach ($record as $res) { ?>

                        <option value="<?php echo $res['id'] ?>" <?php if($result['emp'] == $res['id']) { echo 'selected';}?>>
                        <?php echo $res['fname'];?>  <?php echo $res['lname'];
                      } ?>
                        </option>
                                          >
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                 <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                            <label for="validationCustom02"> Month</label>
                                    
                                              <?php $date=date('F');
                                                 ?>
                                            <input type="text" class="form-control"  name="month" id="month" value="<?php echo $result['month']; ?>" readonly />
                                            
                                            
                                            <div class="valid-feedback"></div>
                                        </div>


                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                    <label for="validationCustom02"> Year</label>
                               
                                    
                                     
                                            <input type="text"  class="form-control"  name="year" id="year" value="<?php echo $result['year']; ?>" readonly/>
                                    <div class="valid-feedback"></div>
                                </div>
                            



                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                    <label for="validationCustom02">Amount Borrow</label>
                                    <input type="text" class="form-control" name="amount" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Amount" value="<?php echo $result['amount'];?>">
                                    <div class="valid-feedback"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                    <label for="validationCustom02">Reason</label>
                                    <textarea type="text" class="form-control" name="reason" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Reason"><?php echo $result['reason'];?></textarea>
                                    <div class="valid-feedback"></div>
                                </div>
                            


                               

                              
                            </div>
                            <br>
                            <center>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <button class="btn btn-primary" type="submit" name="btn_edit">Submit</button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
</div>
<!-- Optional JavaScript -->
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="assets/libs/js/main-js.js"></script>
<script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
<script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
<script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
<script src="assets/vendor/charts/morris-bundle/morris.js"></script>
<script src="assets/vendor/charts/c3charts/c3.min.js"></script>
<script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
<script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
<script src="assets/libs/js/dashboard-ecommerce.js"></script>
<script>
    document.getElementById("newpassword").addEventListener("input", checkPasswordStrength);

    function checkPasswordStrength() {
        var password = document.getElementById("newpassword").value;
        var strengthText = document.getElementById("password-strength");

        var passwordLength = password.length;
        var strengthLabel = "";

        if (passwordLength >= 8 && passwordLength <= 10) {
            strengthLabel = "Medium";
            strengthText.style.color = "orange";
        } else if (passwordLength > 10) {
            strengthLabel = "Strong";
            strengthText.style.color = "green";
        } else {
            strengthLabel = "Weak";
            strengthText.style.color = "red";
        }

        strengthText.innerHTML = strengthLabel;
    }

    document.getElementById("designation").addEventListener("change", function() {
        var incentiveBox = document.getElementById("incentive-box");
        if (this.value == "1") {
            incentiveBox.style.display = "block";
        } else {
            incentiveBox.style.display = "none";
        }
    });

    function addBrand() {
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            if (value.trim() === "") {
                return false;
            }
            if (!/[a-zA-Z]/.test(value)) {
                return false;
            }
            return /^[a-zA-Z0-9\s!@#$%^&*()_-]+$/.test(value);
        }, "Please enter alphanumeric characters with at least one alphabet character.");

        jQuery.validator.addMethod("validEmail", function(value, element) {
            return this.optional(element) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }, "Please enter a valid email address.");

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            if (value.trim() === "") {
                return false;
            }
            return /^[a-zA-Z\s]*$/.test(value);
        }, "Please enter alphabet characters only");

        $.validator.addMethod("noDigits", function(value, element) {
            return this.optional(element) || !/\d/.test(value);
        }, "Please enter a without digits.");

        jQuery.validator.addMethod("noSpacesOnly", function(value, element) {
            return value.trim() !== '';
        }, "Please enter a non-empty value");

        $('#add_brand').validate({
            rules: {
                fname: {
                    required: true,
                    noSpacesOnly: true,
                    alphanumeric: true,
                    noDigits: true,
                },
                lname: {
                    required: true,
                    noSpacesOnly: true,
                    noDigits: true,
                    alphanumeric: true
                },
                email: {
                    required: true,
                    noSpacesOnly: true,
                    validEmail: true
                }
            },
            messages: {
                fname: {
                    required: "Please enter a first name.",
                    pattern: "Only alphanumeric characters are allowed.",
                    alphanumeric: "Only alphanumeric characters are allowed."
                },
                lname: {
                    required: "Please enter a last name.",
                    pattern: "Only alphanumeric characters are allowed.",
                    alphanumeric: "Only alphanumeric characters are allowed."
                },
                email: {
                    required: "Please enter email.",
                }
            },
        });
    }
</script>
