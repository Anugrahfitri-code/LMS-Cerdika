<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sertifikat Kelulusan - LMS Cerdika</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
            color: #2d3748;
            width: 100%;
            height: 100%;
        }

        .border-pattern {
            position: fixed;
            top: 12mm;
            left: 12mm;
            right: 12mm;
            bottom: 12mm;
            border: 5px double #1e40af; 
            background-color: #ffffff;
            z-index: 1;
        }

        .corner-ornament {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 4px solid #d97706; 
            z-index: 2;
        }

        .top-left { top: -4px; left: -4px; border-right: none; border-bottom: none; }
        .top-right { top: -4px; right: -4px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: -4px; left: -4px; border-right: none; border-top: none; }
        .bottom-right { bottom: -4px; right: -4px; border-left: none; border-top: none; }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); 
            width: 90%; 
            text-align: center;
            z-index: 10;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60pt;
            color: rgba(0,0,0,0.03);
            z-index: 0;
            font-weight: bold;
            white-space: nowrap;
            text-transform: uppercase;
            pointer-events: none;
        }

        .header-text {
            font-family: 'Times New Roman', serif;
            font-size: 14pt;
            color: #718096;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .title {
            font-family: 'Times New Roman', serif;
            font-size: 42pt;
            color: #1e3a8a; /* Biru Gelap */
            text-transform: uppercase;
            margin: 0;
            padding-bottom: 15px;
            font-weight: bold;
            line-height: 1;
            border-bottom: 1px solid #e2e8f0;
            display: inline-block;
            padding-left: 40px; 
            padding-right: 40px;
        }

        .presented-text {
            font-size: 12pt;
            color: #4a5568;
            margin-top: 20px;
            margin-bottom: 5px;
            font-style: italic;
        }

        .student-name {
            font-family: 'Helvetica', serif; 
            font-size: 36pt;
            color: #d97706; /* Emas */
            margin: 10px 0;
            font-weight: bold;
            text-transform: capitalize;
        }

        .course-text {
            font-size: 12pt;
            color: #4a5568;
            margin-bottom: 5px;
        }

        .course-title {
            font-size: 20pt;
            font-weight: bold;
            color: #2d3748;
            margin: 5px 0 15px 0;
        }

        .date-text {
            font-size: 10pt;
            color: #718096;
            margin-bottom: 30px;
        }

        /* Tanda Tangan */
        .signature-table {
            width: 100%;
            margin-top: 20px;
        }

        .signature-column {
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #2d3748;
            width: 180px;
            margin: 0 auto 5px auto;
        }

        .signer-name {
            font-weight: bold;
            font-size: 12pt;
            color: #1e3a8a;
        }

        .signer-title {
            font-size: 9pt;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .seal-circle {
            width: 70px;
            height: 70px;
            border: 3px double #d97706;
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d97706;
            font-weight: bold;
            font-size: 16px;
            line-height: 65px; 
        }

        .cert-id {
            position: absolute;
            bottom: 5mm;
            right: 5mm;
            font-size: 8pt;
            color: #cbd5e0;
            font-family: monospace;
        }
    </style>
</head>
<body>

    <div class="border-pattern">
        <div class="corner-ornament top-left"></div>
        <div class="corner-ornament top-right"></div>
        <div class="corner-ornament bottom-left"></div>
        <div class="corner-ornament bottom-right"></div>

        <div class="watermark">LMS CERDIKA OFFICIAL</div>
        
        <div class="cert-id">
            ID: CERT-{{ strtoupper(substr(md5($studentName . $courseName . $completionDate), 0, 12)) }}
        </div>
    </div>

    <div class="content">
        <div class="header-text">LMS Cerdika Official Certification</div>
        
        <div class="title">Certificate of Achievement</div>
        
        <div class="presented-text">This certificate is proudly presented to</div>
        
        <div class="student-name">{{ $studentName }}</div>
        
        <div class="course-text">For successfully completing the course</div>
        
        <div class="course-title">"{{ $courseName }}"</div>
        
        <div class="date-text">Completed on {{ $completionDate }}</div>

        <table class="signature-table">
            <tr>
                <td class="signature-column">
                    <div style="height: 40px;"></div> 
                    <div class="signature-line"></div>
                    <div class="signer-name">{{ $teacherName }}</div>
                    <div class="signer-title">Course Instructor</div>
                </td>
                
                <td class="signature-column">
                    <div class="seal-circle">PASS</div>
                </td>

                <td class="signature-column">
                    <div style="height: 40px;"></div>
                    <div class="signature-line"></div>
                    <div class="signer-name">LMS Cerdika</div>
                    <div class="signer-title">Platform Director</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>