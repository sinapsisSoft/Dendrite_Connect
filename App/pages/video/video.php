<?php
session_start();

if (!isset($_SESSION['User'])) {
  header("../../pages/login/login.html");
} else {
  $var_session  = $_SESSION['User'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ST Dendrite</title>
  <!-- css link -->
  <?php include("../../php/viewHtml/cssLink.php") ?>
</head>

<body id="page-top">
  <div class="loadPage" id="loadPage"></div>
  <input type="hidden" id="User_id">
  <!--Alert-->
  <div id="myAlert"></div>
  <!--Alert-->
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("../../php/viewHtml/slideMenu.php") ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include("../../php/viewHtml/navUser.php") ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">La trivia del pulmón </h1>
            <div class="col-xl-2 col-md-2 mb-2">
              <div class="card shadow h-100 py-2">
                <div class="card-body score">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-success text-uppercase mb-1" style="text-align: center;">TOTAL PUNTOS</div>
                    </div>
                  </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="Video_score" class="text font-weight-bold text-secondary text-uppercase mb-1" style="text-align: center;">0</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-success text-uppercase mb-1">LABORATORIO 1</div>
                    </div>
                  </div>
                  <video src="../../videos/video1.mp4" id="video1" width="100%" height="200" controls poster="../../img/logo_dendrite.png"></video>
                  <button id="buttonvideo1" type="button" class="btn btn-success" data-toggle="modal" data-target="#video1Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-warning text-uppercase mb-1">LABORATORIO 2</div>
                    </div>
                  </div>
                  <video src="../../videos/video1.mp4" id="video2" width="100%" height="200" controls poster="../../img/logo_dendrite.png"></video>
                  <button id="buttonvideo2" type="button" class="btn btn-warning" data-toggle="modal" data-target="#video2Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-danger text-uppercase mb-1">LABORATORIO 3</div>
                    </div>
                  </div>
                  <video src="../../videos/video1.mp4" id="video3" width="100%" height="200" controls poster="../../img/logo_dendrite.png"></video>
                  <button id="buttonvideo3" type="button" class="btn btn-danger" data-toggle="modal" data-target="#video3Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-primary text-uppercase mb-1">LABORATORIO 4</div>
                    </div>
                  </div>
                  <video src="../../videos/video1.mp4" id="video4" width="100%" height="200" controls poster="../../img/logo_dendrite.png"></video>
                  <button id="buttonvideo4" type="button" class="btn btn-primary" data-toggle="modal" data-target="#video4Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-secondary text-uppercase mb-1">LABORATORIO 5</div>
                    </div>
                  </div>
                  <video src="../../videos/video1.mp4" id="video5" width="100%" height="200" controls poster="../../img/logo_dendrite.png"></video>
                  <button id="buttonvideo5" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#video5Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-info text-uppercase mb-1">LABORATORIO 6</div>
                    </div>
                  </div>
                  <video src="../../videos/video1.mp4" id="video6" width="100%" height="200" controls poster="../../img/logo_dendrite.png"></video>
                  <button id="buttonvideo6" type="button" class="btn btn-info" data-toggle="modal" data-target="#video6Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Modal Video1 -->
      <div class="modal fade" id="video1Modal" tabindex="-1" aria-labelledby="video1ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video1ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Escriba aquí la pregunta que deberá ser respondida del modal 1</p>
              <div id="bodyModalvideo1" class="answerHidde">
                <p>Aquí se muestra la respuesta del modal 1</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video1 -->
      <!-- Modal Video2 -->
      <div class="modal fade" id="video2Modal" tabindex="-1" aria-labelledby="video2ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video2ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Escriba aquí la pregunta que deberá ser respondida  del modal 2</p>
              <div id="bodyModalvideo2" class="answerHidde">
                <p>Aquí se muestra la respuesta del modal 2</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video2 -->
      <!-- Modal Video3 -->
      <div class="modal fade" id="video3Modal" tabindex="-1" aria-labelledby="video3ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video3ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Escriba aquí la pregunta que deberá ser respondida del modal 3</p>
              <div id="bodyModalvideo3" class="answerHidde">
                <p>Aquí se muestra la respuesta del modal 3</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video3 -->
      <!-- Modal Video4 -->
      <div class="modal fade" id="video4Modal" tabindex="-1" aria-labelledby="video4ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video4ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Escriba aquí la pregunta que deberá ser respondida del modal 4</p>
              <div id="bodyModalvideo4" class="answerHidde">
                <p>Aquí se muestra la respuesta del modal 4</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video4 -->
      <!-- Modal Video5 -->
      <div class="modal fade" id="video5Modal" tabindex="-1" aria-labelledby="video5ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video5ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Escriba aquí la pregunta que deberá ser respondida del modal 5</p>
              <div id="bodyModalvideo5" class="answerHidde">
                <p>Aquí se muestra la respuesta del modal 5</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video5 -->
      <!-- Modal Video6 -->
      <div class="modal fade" id="video6Modal" tabindex="-1" aria-labelledby="video6ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video6ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Escriba aquí la pregunta que deberá ser respondida del modal 6</p>
              <div id="bodyModalvideo6" class="answerHidde">
                <p>Aquí se muestra la respuesta  del modal 6</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video6 -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <script>
                document.write(new Date().getFullYear());
              </script> | Sinapsis Technologies. </span>

          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="video1ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="video1ModalLabel">¿Seguro que quieres salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Selecciona "Cerrar sesión" a continuación si está listo para finalizar su sesión personal.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../../php/class/closeSession.php" onclick="closeSession()">Cerrar Sessión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../js/demo/chart-area-demo.js"></script>
  <script src="../../js/demo/chart-pie-demo.js"></script>
  <!-- Page functión scripts -->
  <script src="../../js/functionsSite.js"></script>
  <script src="../../js/Storage.js"></script>
  <script src="js/video.js"></script>
  <script>
    window.onload = loadView
  </script>

</body>

</html>