<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        /* -------------------------------------
            GLOBAL RESETS
        ------------------------------------- */

        /*All the styling goes here*/

        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }

        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table td,
        .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm td,
        .table-sm th {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table-borderless tbody+tbody,
        .table-borderless td,
        .table-borderless th,
        .table-borderless thead th {
            border: 0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-primary,
        .table-primary>td,
        .table-primary>th {
            background-color: #b8daff;
        }

        .table-primary tbody+tbody,
        .table-primary td,
        .table-primary th,
        .table-primary thead th {
            border-color: #7abaff;
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff;
        }

        .table-hover .table-primary:hover>td,
        .table-hover .table-primary:hover>th {
            background-color: #9fcdff;
        }

        .table-secondary,
        .table-secondary>td,
        .table-secondary>th {
            background-color: #d6d8db;
        }

        .table-secondary tbody+tbody,
        .table-secondary td,
        .table-secondary th,
        .table-secondary thead th {
            border-color: #b3b7bb;
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf;
        }

        .table-hover .table-secondary:hover>td,
        .table-hover .table-secondary:hover>th {
            background-color: #c8cbcf;
        }

        .table-success,
        .table-success>td,
        .table-success>th {
            background-color: #c3e6cb;
        }

        .table-success tbody+tbody,
        .table-success td,
        .table-success th,
        .table-success thead th {
            border-color: #8fd19e;
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb;
        }

        .table-hover .table-success:hover>td,
        .table-hover .table-success:hover>th {
            background-color: #b1dfbb;
        }

        .table-info,
        .table-info>td,
        .table-info>th {
            background-color: #bee5eb;
        }

        .table-info tbody+tbody,
        .table-info td,
        .table-info th,
        .table-info thead th {
            border-color: #86cfda;
        }

        .table-hover .table-info:hover {
            background-color: #abdde5;
        }

        .table-hover .table-info:hover>td,
        .table-hover .table-info:hover>th {
            background-color: #abdde5;
        }

        .table-warning,
        .table-warning>td,
        .table-warning>th {
            background-color: #ffeeba;
        }

        .table-warning tbody+tbody,
        .table-warning td,
        .table-warning th,
        .table-warning thead th {
            border-color: #ffdf7e;
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1;
        }

        .table-hover .table-warning:hover>td,
        .table-hover .table-warning:hover>th {
            background-color: #ffe8a1;
        }

        .table-danger,
        .table-danger>td,
        .table-danger>th {
            background-color: #f5c6cb;
        }

        .table-danger tbody+tbody,
        .table-danger td,
        .table-danger th,
        .table-danger thead th {
            border-color: #ed969e;
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7;
        }

        .table-hover .table-danger:hover>td,
        .table-hover .table-danger:hover>th {
            background-color: #f1b0b7;
        }

        .table-light,
        .table-light>td,
        .table-light>th {
            background-color: #fdfdfe;
        }

        .table-light tbody+tbody,
        .table-light td,
        .table-light th,
        .table-light thead th {
            border-color: #fbfcfc;
        }

        .table-hover .table-light:hover {
            background-color: #ececf6;
        }

        .table-hover .table-light:hover>td,
        .table-hover .table-light:hover>th {
            background-color: #ececf6;
        }

        .table-dark,
        .table-dark>td,
        .table-dark>th {
            background-color: #c6c8ca;
        }

        .table-dark tbody+tbody,
        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #95999c;
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe;
        }

        .table-hover .table-dark:hover>td,
        .table-hover .table-dark:hover>th {
            background-color: #b9bbbe;
        }

        .table-active,
        .table-active>td,
        .table-active>th {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-hover .table-active:hover>td,
        .table-hover .table-active:hover>th {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55;
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .table-dark {
            color: #fff;
            background-color: #343a40;
        }

        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #454d55;
        }

        .table-dark.table-bordered {
            border: 0;
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-dark.table-hover tbody tr:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.075);
        }

        @media (max-width: 575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-sm>.table-bordered {
                border: 0;
            }
        }

        @media (max-width: 767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-md>.table-bordered {
                border: 0;
            }
        }

        @media (max-width: 991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-lg>.table-bordered {
                border: 0;
            }
        }

        @media (max-width: 1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-xl>.table-bordered {
                border: 0;
            }
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive>.table-bordered {
            border: 0;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */

        .body {
            background-color: #f6f6f6;
            width: 100%;
        }

        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }

        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }

        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }

        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }

        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }

        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }

        a {
            color: #3498db;
            text-decoration: underline;
        }

        /* -------------------------------------
            BUTTONS
        ------------------------------------- */
        .btn {
            box-sizing: border-box;
            width: 100%;
        }

        .btn>tbody>tr>td {
            padding-bottom: 15px;
        }

        .btn table {
            width: auto;
        }

        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }

        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
            background-color: #3498db;
        }

        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }

        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }

        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class="body"] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table[class="body"] p,
            table[class="body"] ul,
            table[class="body"] ol,
            table[class="body"] td,
            table[class="body"] span,
            table[class="body"] a {
                font-size: 16px !important;
            }

            table[class="body"] .wrapper,
            table[class="body"] .article {
                padding: 10px !important;
            }

            table[class="body"] .content {
                padding: 0 !important;
            }

            table[class="body"] .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table[class="body"] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table[class="body"] .btn table {
                width: 100% !important;
            }

            table[class="body"] .btn a {
                width: 100% !important;
            }

            table[class="body"] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            .btn-primary table td:hover {
                background-color: #34495e !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }

    </style>
</head>

<body class="">
    <span class="preheader">Création du compte</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="containersimple">
                <div class="contentsimple" style="padding-top: 10px;">
                    @foreach ($filieresnotes as $index => $filierenote)
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th rowspan="2" colspan="2"></th>
                                    <th colspan="2">Session 1</th>
                                    <th colspan="2">Session 2</th>
                                </tr>

                                <tr>
                                    <th>Note</th>
                                    <th>Résultat</th>

                                    <th>Note</th>
                                    <th>Résultat</th>
                                </tr>

                                <tr>
                                    <td>
                                        <font style="padding-left: 10px">
                                            {{ $filierenote['filiere']->niveau }}ème année
                                            {{ $filierenote['filiere']->diplome }} :
                                            {{ $filierenote['filiere']->nom }}
                                            ({{ $filierenote['filiere']->shortcut }})
                                        </font>
                                    </td>
                                    <td>AN{{ $filierenote['filiere']->niveau }}</td>
                                    <td>
                                        @if ($filierenote['CheckAnne'])
                                            {{ $filierenote['noteAnne'] }}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td>
                                        @if ($filierenote['CheckAnneRatt'])
                                            {{ $filierenote['noteRatt'] }}
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                                <tr></tr>
                                @foreach ($filierenote['filiere']->semestres as $semestre)
                                    <tr>
                                        <td>
                                            <font style="padding-left: 30px">Semestre
                                                {{ $semestre->num }}
                                                {{ $filierenote['filiere']->diplome }} :
                                                {{ $filierenote['filiere']->nom }}
                                                ({{ $filierenote['filiere']->shortcut }})
                                            </font>
                                        </td>
                                        <td>SE{{ $semestre->num }}</td>
                                        @foreach ($filierenote['noteSemestres'] as $noteSemestre)
                                            @if ($noteSemestre['idSemestre'] == $semestre->idSemestre)
                                                @php
                                                    $semestreinfo = $noteSemestre;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <td>
                                            @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['CheckNormal'])
                                                {{ $semestreinfo['noteNormal'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['CheckNormal'])
                                                {{ $semestreinfo['etat'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['noteRatt'] >= 0 && $semestreinfo['etat'] == 'Non Validé' && $semestreinfo['CheckRatt'])
                                                {{ $semestreinfo['noteRatt'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['noteRatt'] >= 0 && $semestreinfo['etat'] == 'Non Validé' && $semestreinfo['CheckRatt'])
                                                {{ $semestreinfo['etatRatt'] }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr></tr>
                                    @foreach ($semestre->modules as $module)
                                        <tr>
                                            <td>
                                                <font style="padding-left: 50px">{{ $module->nom }}
                                                </font>
                                            </td>
                                            <td>MO</td>
                                            <td>
                                                @if ($semestreinfo['CheckNormal'])
                                                    @foreach ($filierenote['noteModules'] as $noteModule)
                                                        @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0)
                                                            {{ $noteModule['noteNormal'] }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($semestreinfo['CheckNormal'])
                                                    @foreach ($filierenote['noteModules'] as $noteModule)
                                                        @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0)
                                                            @if ($noteModule['noteNormal'] >= $consval)
                                                                Validé
                                                            @elseif ($noteModule['noteNormal'] >= $consratt)
                                                                Rattrapage
                                                            @else
                                                                Non Validé
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($semestreinfo['CheckRatt'])
                                                    @foreach ($filierenote['noteModules'] as $noteModule)
                                                        @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0 && $noteModule['noteNormal'] < $consval && $noteModule['noteRatt'] >= 0)
                                                            @if ($noteModule['noteNormal'] >= $consratt)
                                                                {{ $noteModule['noteRatt'] }}
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($semestreinfo['CheckRatt'])
                                                    @foreach ($filierenote['noteModules'] as $noteModule)
                                                        @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0 && $noteModule['noteNormal'] < $consval && $noteModule['noteRatt'] >= 0)
                                                            @if ($noteModule['noteNormal'] >= $consratt)
                                                                @if ($noteModule['noteRatt'] >= $consval)
                                                                    Validé
                                                                @else
                                                                    Non Validé
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr></tr>
                                        @foreach ($module->matieres as $matiere)
                                            <tr>
                                                <td>
                                                    <font style="padding-left: 70px">{{ $matiere->nom }}
                                                    </font>
                                                </td>
                                                <td>EM</td>
                                                <td>
                                                    @if ($semestreinfo['CheckNormal'])
                                                        @foreach ($etudiant->notes as $note)
                                                            @if ($note->matiere->idMatiere == $matiere->idMatiere)
                                                                {{ $note->noteGeneral }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($semestreinfo['CheckNormal'])
                                                        @foreach ($etudiant->notes as $note)
                                                            @if ($note->matiere->idMatiere == $matiere->idMatiere)
                                                                @if ($note->noteGeneral < $consval)
                                                                    Non Validé
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($semestreinfo['CheckRatt'])
                                                        @foreach ($etudiant->notes as $note)
                                                            @if ($note->matiere->idMatiere == $matiere->idMatiere && $note->noteRatt != null)
                                                                {{ $note->noteRatt }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($semestreinfo['CheckRatt'])
                                                        @foreach ($etudiant->notes as $note)
                                                            @if ($note->matiere->idMatiere == $matiere->idMatiere && $note->noteRatt != null)
                                                                @if ($note->noteRatt < $consval)
                                                                    Non Validé
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>
