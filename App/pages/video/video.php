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
                      <div id="counter"></div>
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
                      <div id="visibilityvideo1" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoAZ.mp4" id="video1" width="100%" height="200" controls poster="../../img/videos/LogoAZ.png"></video>
                  <button id="buttonvideo1" type="button" class="btn btn-success" data-toggle="modal" data-target="#video1Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="visibilityvideo2" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoBI.mp4" id="video2" width="100%" height="200" controls poster="../../img/videos/LogoBI.png"></video>
                  <button id="buttonvideo2" type="button" class="btn btn-warning" data-toggle="modal" data-target="#video2Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="visibilityvideo3" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoGSK.mp4" id="video3" width="100%" height="200" controls poster="../../img/videos/LogoGSK.png"></video>
                  <button id="buttonvideo3" type="button" class="btn btn-danger" data-toggle="modal" data-target="#video3Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="visibilityvideo4" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoNovartis.mp4" id="video4" width="100%" height="200" controls poster="../../img/videos/LogoNovartis.png"></video>
                  <button id="buttonvideo4" type="button" class="btn btn-primary" data-toggle="modal" data-target="#video4Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="visibilityvideo5" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoPfizer.mp4" id="video5" width="100%" height="200" controls poster="../../img/videos/LogoPfizer.png"></video>
                  <button id="buttonvideo5" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#video5Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="visibilityvideo6" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoAbbott.mp4" id="video6" width="100%" height="200" controls poster="../../img/videos/LogoAbbott.png"></video>
                  <button id="buttonvideo6" type="button" class="btn btn-info" data-toggle="modal" data-target="#video6Modal" disabled>Ver respuesta</button>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div id="visibilityvideo7" class="font-weight-bold"><span class="material-icons">visibility</span></div>
                    </div>
                  </div>
                  <video src="../../videos/videoSanofi.mp4" id="video7" width="100%" height="200" controls poster="../../img/videos/LogoSanofi.png"></video>
                  <button id="buttonvideo7" type="button" class="btn btn-success" data-toggle="modal" data-target="#video7Modal" disabled>Ver respuesta</button>
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
              <p>Un test corto e integral para medir el impacto sintomático y el estado de salud por la EPOC es: </p>
              <div id="bodyModalvideo1" class="answerHidde">
                <p><strong>El CAT (COPD Assessment Test)<br>(Fuente: GOLD 2018)</strong></p>
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
              <p>Los fenotipos más comunes de asma, además de Asma alérgica y Asma no alérgica, son:</p>
              <div id="bodyModalvideo2" class="answerHidde">
                <p><strong>Asma de inicio tardío, Asma con obstrucción fija de la vía aérea y Asma con obesidad 
                  <br>(Fuente: GINA 2018)</strong></p>
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
              <p>Un test positivo de reversibilidad en adultos con Asma, incluye:</p>
              <div id="bodyModalvideo3" class="answerHidde">
                <p><strong>Mejoría posbroncodilatador del VEF1 de más de 200 ml y más de 12% del valor basal <br>(Fuente: GINA 2018)</strong></p>
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
              <p>¿A qué grupo de la Clasificación de la Hipertensión Pulmonar pertenece la Hipertensión Pulmonar secundaria a EPOC?</p>
              <div id="bodyModalvideo4" class="answerHidde">
                <p><strong>Pertenece al Grupo 3 <br>(Fuente: ESC/ERS Guías de Hipertensión Pulmonar EHJ 2016)</strong></p>
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
              <p>¿Qué método de clasificación de gravedad de la Neumonía Adquirida en la Comunidad (NAC) se recomienda utilizar en Colombia? </p>
              <div id="bodyModalvideo5" class="answerHidde">
                <p><strong> Las escalas CURB-65 o CRB-65 <br>(Fuente: Recomendaciones para el Diagnóstico, tratamiento y prevención de la NAC en Colombia 2013)</strong></p>
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
              <p>¿Cuál es el tratamiento recomendado para la Infección Tuberculosa Latente (ITL)?</p>
              <div id="bodyModalvideo6" class="answerHidde">
                <p><strong>Isoniacida diariamente por 6 meses <br>(Fuente: Guías de Promoción de la salud y prevención de enfermedades en la salud pública, Ministerio de la Protección Social, Colombia 2007)</strong></p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video6 -->
      <!-- Modal Video7 -->
      <div class="modal fade" id="video7Modal" tabindex="-1" aria-labelledby="video7ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video7ModalLabel">Responde la pregunta a continuación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>¿Cuál es la recomendación para el seguimiento de un nódulo sólido indeterminado estable por 2 años?</p>
              <div id="bodyModalvideo7" class="answerHidde">
                <p><strong>No requiere más seguimiento <br>(Fuente: Guías CHEST para el manejo del Cáncer Pulmonar 2013)</strong></p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Video7 -->
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
  <script src="../../js/preLoadPage.js"></script>
  <script src="js/video.js"></script>
  <script>
    window.onload = loadView
  </script>

</body>

</html>