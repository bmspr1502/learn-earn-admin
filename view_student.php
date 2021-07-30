<?php
session_start();
include "api/dbconnect.php";
//echo "<script>window.alert('Hello')</script>";
if ((!isset($_POST['student_id']) && !isset($_SESSION['student_id'])))
  header('location: admin.php');
else {
  if (isset($_POST['student_id']) || !isset($_SESSION['student_id']))
    $_SESSION['student_id'] = $_POST['student_id'];
}
?>
<!DOCTYPE html>
<style>
  .topic_tabs {
    border: 2px solid #009CEA;
    font-family: "Raleway", sans-serif;
    padding-top: 6px;
    /*margin-bottom: 3px;*/
  }

  .heading {
    font-weight: 900;
    padding-right: 20%;

  }

  .text {
    padding-left: 20%;
  }
</style>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Student Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href='cards.css' rel='stylesheet'>



</head>

<body>

  <?php include 'navbar.php'; ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Inner Page</li>
        </ol>
        <h2>Inner Page</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">

        <div class='jumbotron'>
          <p>
            Example inner page template
          </p>
        </div>


        <div class='container'>
          <h2>Student <?php echo $_SESSION['student_id'] ?></h2>

          <div id='tasks_assigned'>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->

  <?php include 'footer.php'; ?>

  <!-- Modal -->
  <div class="modal fade" id="newTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newTaskModalLabel">Create a New Task for Student - <?php echo $_SESSION['student_id'] ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id='newTaskForm'>
          <div class="modal-body">
            <section id="portfolio-details" class="portfolio-details">
              <div class="container">

                <div class="row gy-4">

                  <div class="col-lg-8 " data-aos="zoom-in">
                    <div>
                      <div class='form-group mt-3'>
                        <label>Title of Task</label>
                        <input class='form-control' type='text' name='Task_title' placeholder='Enter the title' required>
                      </div>
                      <div class='form-group mt-3'>
                        <label>Description</label>
                        <textarea class='form-control' name='Description' placeholder='Enter the description'></textarea>
                      </div>

                      <input type='hidden' name='mentor_id' value="<?php echo $_SESSION['admin_id'] ?>">
                      <input type='hidden' name='Student_id' value="<?php echo $_SESSION['student_id'] ?>">
                      <div class="question_div mt-3">
                        <p>Reference material upload (optional)</p>
                        <input type='file' class='form-control' id='new_task_pdf' name='Task_pdf_file' onchange="uploadFile()" />
                        <input type='hidden' id='new_task_pdf_name' name='Task_pdf' />
                        <p class='bg-success text-white' id='upload_response'></p>
                      </div>
                      <div class="portfolio-description">
                        <h2>Comments</h2>
                        <textarea class='form-control' name='Comment' placeholder='Write your comment.'></textarea>
                      </div>

                    </div>
                  </div>

                  <div class="col-lg-4" data-aos="fade-left">
                    <div class="portfolio-info">
                      <h3>DETAILS</h3>
                      <ul>
                        <li><strong>Due</strong>: <input type='datetime-local' class='form-control' name='Due_Timestamp' /></li>
                        <li><strong>Marks Possible</strong><input type='number' class='form-control' name='Marks_possible' /></li>
                      </ul>
                    </div>

                  </div>

                </div>

              </div>
            </section>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" name='submit' class="btn btn-primary" value='Save changes' />
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="taskViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="taskViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="taskViewModalLabel">View Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div id='task_details'></div>


        </div>
      </div>
    </div>
  </div>
  <script>
    function open_task(taskid, status) {
      $.post('api/task_details.php', {
        Task_id: taskid,
        status: status
      }, function(data) {
        $('#task_details').html(data);
      })
    }

    function tasks_assigned() {
      $.post('api/tasks_assigned.php', {
        student_id: '<?php echo $_SESSION['student_id']; ?>'
      }, function(data) {
        $('#tasks_assigned').html(data);
      })
    }

    function uploadFile() {
      var fd = new FormData();
      var files = $('#new_task_pdf')[0].files[0];

      fd.append('file', files);

      $.ajax({
        url: 'api/upload_file.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: function(response) {
          $('#new_task_pdf_name').val(response);
          $('#upload_response').html('File uploaded as : ' + response);
        },
      });
    }

    $(document).ready(function() {
      tasks_assigned();

      $('#newTaskForm').submit(function(event) {
        event.preventDefault();
        var formValues = $(this).serialize();
        $.post("api/add_new_task.php", formValues, function(data) {
          alert(data);
          tasks_assigned();
          if (data === 'Task Added') {
            $('#newTaskModal').modal('toggle');
          }
        });

      })
    })
  </script>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>