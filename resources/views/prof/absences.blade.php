<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Absences</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body>
    @extends('layouts.prof')
    <div class="main-container">

        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Table d'absence</h4>
                        <p class="mb-26"></p>
                    </div>
                    <table class="data-table table nowrap">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Matiére</th>
                                <th>Filière</th>
                                <th>Date d'absence</th>
                                <th>État</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absences as $absence)
                            <tr>
                                <td>{{ $absence->IdAbsence }}</td>  
                                <td>{{ $absence->nomMatiere }}</td>
                                <td>{{ $absence->nomFiliere }}</td>
                                <td>{{ $absence->dateAbsencee }}</td>
                                @if($absence->etat == 1)
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="green">Rattrapé</span>
                                @else
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#c2a502">En attend</span>
                                @endif
                                </td>
                            </tr>
				            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Déclaration d'absence</h4>
                        <p class="mb-26"></p>
                    </div>
                    <div class="wizard-content">
                        
                        <form class="tab-wizard wizard-circle wizard" method='POST' action='/addRatt'>
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Matiére :</label>
                                            <select class="custom-select2 form-control" name="matiere" style="width: 100%; height: 38px;" required>
                                                    @foreach ($MatiersList as $matier)
                                                        <option value={{ $matier->nomMatier }} >{{ $matier->nomMatier }}</option> 
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date d'absence :</label>
                                            <input class="form-control datetimepicker" name="dataAbsence" placeholder="Date d'absence :" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dates de rattrapage possible :</label>
                                            <input class="form-control datetimepicker-range datetimepicker" name="dateRatt" placeholder="Date de rattrapage :" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox mb-5" style="padding-top: 42px;">
                                            <input type="checkbox" name="informerEtudiants"class="custom-control-input" id="customCheck1" >
                                            <label class="custom-control-label" for="customCheck1">Informer les
                                                étudiants pour l'absence</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div style="text-align: right;">
                                <input class="btn btn-primary" type="submit" value="Confirmer">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                        Hingarajiya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="vendors/scripts/dashboard3.js"></script>
    <script src="src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="vendors/scripts/steps-setting.js"></script>

</body>

</html>