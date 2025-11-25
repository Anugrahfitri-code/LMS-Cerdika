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

        /* --- Bingkai / Frame --- */
        .border-pattern {
            position: absolute;
            top: 10mm;
            left: 10mm;
            right: 10mm;
            bottom: 10mm;
            border: 5px double #1e40af; /* Biru */
            background-color: #ffffff;
            z-index: -1;
        }

        .corner-ornament {
            position: absolute;
            width: 30px;
            height: 30px;
            border: 4px solid #d97706; /* Emas */
            z-index: 1;
        }

        .top-left { top: -4px; left: -4px; border-right: none; border-bottom: none; }
        .top-right { top: -4px; right: -4px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: -4px; left: -4px; border-right: none; border-top: none; }
        .bottom-right { bottom: -4px; right: -4px; border-left: none; border-top: none; }

        /* --- Watermark --- */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            font-size: 80pt;
            color: rgba(0,0,0,0.02);
            font-weight: bold;
            text-transform: uppercase;
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
        }

        /* --- Wrapper Konten Utama --- */
        .content-wrapper {
            position: absolute;
            top: 10mm;
            left: 10mm;
            right: 10mm;
            bottom: 10mm;
            padding: 40px;
            text-align: center;
            box-sizing: border-box;
        }

        /* --- Bagian Header (Atas) --- */
        .header-section {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .header-text {
            font-family: 'Times New Roman', serif;
            font-size: 16pt;
            color: #718096;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .title {
            font-family: 'Times New Roman', serif;
            font-size: 48pt;
            color: #1e3a8a;
            text-transform: uppercase;
            margin: 0;
            font-weight: bold;
            line-height: 1;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        /* --- Bagian Body (Tengah) --- */
        .body-section {
            /* margin-bottom dikurangi agar muat dengan footer yang dinaikkan */
            margin-bottom: 30px; 
        }

        .presented-text {
            font-size: 14pt;
            color: #4a5568;
            margin-bottom: 10px;
            font-style: italic;
        }

        .student-name {
            font-family: 'Helvetica', serif; 
            font-size: 40pt; /* Sedikit dikecilkan agar proporsional */
            color: #d97706;
            margin: 15px auto;
            font-weight: bold;
            text-transform: capitalize;
            border-bottom: 2px solid #cbd5e0;
            display: inline-block;
            padding-bottom: 5px;
            min-width: 400px;
        }

        .course-text {
            font-size: 14pt;
            color: #4a5568;
            margin-top: 15px;
        }

        .course-title {
            font-size: 22pt;
            font-weight: bold;
            color: #2d3748;
            margin: 10px 0 5px 0;
        }

        .date-text {
            font-size: 11pt;
            color: #718096;
            margin-top: 10px;
        }

        /* --- Bagian Footer (Bawah / TTD) --- */
        .footer-section {
            position: absolute;
            /* PERBAIKAN DI SINI: */
            /* Sebelumnya 60px, sekarang 110px agar naik ke atas menjauhi garis */
            bottom: 110px; 
            left: 40px;
            right: 40px;
            width: auto;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-column {
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #2d3748;
            width: 200px;
            margin: 0 auto 8px auto;
        }

        .signer-name {
            font-weight: bold;
            font-size: 12pt; /* Ukuran font disesuaikan */
            color: #1e3a8a;
        }

        .signer-title {
            font-size: 9pt; /* Ukuran font disesuaikan */
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .seal-circle {
            width: 80px;
            height: 80px;
            border: 3px double #d97706;
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d97706;
            font-weight: bold;
            font-size: 16px;
            line-height: 75px; 
            text-align: center;
            transform: rotate(-10deg);
            opacity: 0.8;
        }

        .cert-id {
            position: absolute;
            bottom: 30px; /* Posisi ID sedikit dinaikkan juga */
            right: 40px;
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
    </div>

    <div class="content-wrapper">
        
        <div class="header-section">
            <div class="header-text">LMS Cerdika Official Certification</div>
            <div class="title">Certificate of Achievement</div>
        </div>
        
        <div class="body-section">
            <div class="presented-text">This certificate is proudly presented to</div>
            
            <div class="student-name">{{ $studentName }}</div>
            
            <div class="course-text">For successfully completing the course</div>
            <div class="course-title">"{{ $courseName }}"</div>
            
            <div class="date-text">Completed on {{ $completionDate }}</div>
        </div>

        <div class="footer-section">
            <table class="signature-table">
                <tr>
                    <td class="signature-column">
                        <div style="height: 40px;"></div> 
                        <div class="signature-line"></div>
                        <div class="signer-name">{{ $teacherName }}</div>
                        <div class="signer-title">Course Instructor</div>
                    </td>
                    
                    <td class="signature-column">
                        <div class="seal-circle">VALID</div>
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

        <div class="cert-id">
            ID: CERT-{{ strtoupper(substr(md5($studentName . $courseName . $completionDate), 0, 12)) }}
        </div>

    </div>

</body>
</html>