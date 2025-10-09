<!DOCTYPE html>
<html>
<head>
    <title>Project Report PDF</title>
    
    <style>
         body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
         h1, h2, h3 {
         color: #212529;
         margin: 0 0 10px;
         }
         h1 {
         border-bottom: 3px solid #198754;
         padding-bottom: 8px;
         }
         section {
         margin-bottom: 30px;
         }
         dl {
         display: grid;
         grid-template-columns: max-content 1fr;
         gap: 6px 20px;
         }
         dt {
         font-weight: 600;
         }
         dd {
         margin: 0 0 12px 0;
         }
         ul {
         margin: 0 0 12px 20px;
         }
         .quiz {
         background: #f5f6fa;
         border-left: 5px solid #198754;
         padding: 15px;
         border-radius: 4px;
         }
         table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 10px;
         margin-bottom: 20px;
         }
         th, td {
         border: 1px solid #198754;
         padding: 8px 12px;
         text-align: center;
         }
         th {
         background-color: #198754;
         color: #fff;
         }
         .answer {
            margin-top: 0px;
            margin-left: 0px;
            font-weight: normal;
            color: #333;
            margin-bottom: 10px;
        }
        .ml-20 {
            margin-left: 70px !important;
        }
        section.verification-section {
            border-top: 2px solid #198754;
            padding-top: 15px;
        }
          section.realtionship-section {
            border-top: 2px solid #198754;
            padding-top: 50px;
        }
         p {
            margin: 0 0 10px;
        }
         .answer .yes {
         color: #2e7d32; /* green */
         font-weight: bold;
         }
         .answer .no {
         color: #c62828; /* red */
         font-weight: bold;
         }
         /* Custom keyword colors */
         .danger {
         color: #d62828;
         font-weight: bold;
         }
         .success {
         color: #198754;
         font-weight: bold;
         }
         .form-select{
            border: 1px solid #00A14C;
            border-radius: 10px;
            height: 50px;
            width: 285px;
            width: 50%;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            color: #000000;
            font-family: 'Inter-Regular';
         }
      </style>
</head>
<body>
    @include('adult.reports.component.report')
</body>
</html>