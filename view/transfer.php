<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CU BANK</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../lib/css/style.pink.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../lib/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../lib/img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <link rel="stylesheet" href="../lib/css/sweetalert2.css">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<style>
    .pink {
        color: #ef5285;
    }
    
    .bg-pink {
        background: #ef5285;
    }
</style>

<body>
    <header class="header">
        <nav class="navbar" style="background: #ef5285">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand -->
                        <a id="homeBtn" href="../view/main.html" class="navbar-brand">
                            <div class="brand-text brand-big">
                                <span>
                                    <strong>CU</strong>
                                </span> BANK</div>
                            <!-- Toggle Button-->
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Name-->
                        <li class="nav-item d-flex align-items-center">
                            <a href="#" class="nav-link"></a>
                        </li>
                        <!-- Logout    -->
                        <li class="nav-item">
                            <a id="logoutBtn" href="#" class="nav-link logout">ออกจากระบบ
                                <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="" id="subview">
        <section class="forms">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a id="backBtn" href="../view/main.html" class="btn btn-secondary">
                            <i class="fa fa-reply"></i> ย้อนกลับ</a>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <!-- Horizontal Form-->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="h4">โอนเงิน</h3>
                            </div>
                            <div class="card-body">
                                <p>โอนเงินจากบัญชีหมายเลข :
                                    <span class="pink"><span id="accSrcNo">accNo</span> (<span id="accName">accName</span>)</span>
                                </p>
                                <p>ยอดเงินคงเหลือ:
                                    <span id="accBalance" class="pink">accBalance</span> บาท</p>
                                <p>ไปยัง</p>
                                <form id="transferForm" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">หมายเลขบัญชี
                                            <br>10 หลัก</label>
                                        <div class="col-sm-6">
                                            <input id="accDesNo" type="text" minlength="10" maxlength="10" class="form-control form-control-warning" required>
                                            <small class="form-text"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">จำนวนเงิน
                                        </label>
                                        <div class="col-sm-6">
                                            <input id="amount" type="number" min="1" class="form-control form-control-warning" required>
                                            <small class="form-text"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <input type="submit" value="ยืนยัน" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Inline Form-->
                    <!-- Modal Form-->
                    <!-- Form Elements -->
                </div>
            </div>
        </section>
    </div>

    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../lib/js/tether.min.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <script src="../lib/js/jquery.cookie.js"></script>
    <script src="../lib/js/jquery.validate.min.js"></script>
    <script src="../lib/js/front.js"></script>
    <script src="../lib/js/sweetalert2.js"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            /*$.ajax({
                method: "GET",
                url: "/src/controller.php",
                dataType: "json",
                data: {
                    accNo: "want to know"
                }
            })
            .done(function(data) {
                $("#accSrcNo").data("accNo",data.accountNumber);
                $("#accSrcNo").text(data.accountNumber.replace(/(\d{1})\-?(\d{3})\-?(\d{3})\-?(\d{3})/,'$1-$2-$3-$4'));
                $("#accName").text(data.accountName);
                $("#accBalance").text(commaSeparateNumber(data.accountBalance));
            });*/
            var accSrcNo = '<?php echo $this->accNumber;?>';
            var accName = '<?php echo $this->accName;?>';
            $("#accSrcNo").data("accNo",<?php echo $this->accNumber;?>);
            $("#accSrcNo").text(accSrcNo.toString().replace(/(\d{1})\-?(\d{3})\-?(\d{3})\-?(\d{3})/,'$1-$2-$3-$4'));
            $("#accName").text(accName.toString());
            $("#accBalance").text(commaSeparateNumber(<?php echo $this->amount;?>));
        });

        $("#transferForm").submit(function(event) {
            $.ajax({
                    method: "POST",
                    url: "/src/controller.php",
                    dataType: "json",
                    data: {
                        srcNumber: $("#accSrcNo").data("accNo"),
                        targetNumber: $("#accDesNo").val(),
                        amount: $("#amount").val()
                    }

                })
                .done(function(data) {
                    console.log(data);
                    swal(
                        'โอนเงินเรียบร้อย',
                        'ยอดเงินคงเหลือ = ' + data.accountBalance + " บาท",
                        'success'
                    );
                });
            event.preventDefault();
        });

        function commaSeparateNumber(val){
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
            }
            return val;
        }
    </script>
</body>

</html>