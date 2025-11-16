<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sertifikat Kelulusan</title>
    <style>
        html, body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-size: 100%;
        }
        .certificate-page {
            position: relative;
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            overflow: hidden;
        }
        .container {
            position: absolute;
            top: 15mm;
            left: 15mm;
            right: 15mm;
            bottom: 15mm;
            border: 8px solid #0d47a1;
            padding: 20px 40px;
            box-sizing: border-box;
            text-align: center;
        }

        h1 {
            font-size: 42px;
            color: #0d47a1;
            margin-top: 30px;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 20px;
            color: #555;
            margin-bottom: 50px;
        }
        .presented-to {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }
        .student-name {
            font-family: 'serif', 'Times New Roman', serif;
            font-size: 48px;
            font-weight: bold;
            color: #1565c0;
            margin-bottom: 15px;
        }
        .name-line {
            width: 450px;
            border-bottom: 1.5px solid #aaa;
            margin: 0 auto 30px auto;
        }
        .description {
            font-size: 18px;
            color: #444;
            margin-bottom: 60px;
        }
        .signature {
            margin-top: 40px;
            font-size: 18px;
            color: #333;
        }
        .signature-line {
            width: 250px;
            border-bottom: 1.5px solid #555;
            margin: 0 auto 8px auto;
        }
    </style>
</head>
<body>
    <div class="certificate-page">
        <div class="container">
            
            <h1>SERTIFIKAT KELULUSAN</h1>
            <p class="subtitle">CERTIFICATE OF COMPLETION</p>
            
            <p class="presented-to">Dengan ini diberikan kepada:</p>
            
            <p class="student-name">{{ $studentName }}</p>
            <div class="name-line"></div>
            
            <p class="description">
                Atas keberhasilannya telah menyelesaikan kursus:<br>
                <strong>{{ $courseName }}</strong><br>
                Pada tanggal: {{ $completionDate }}
            </p>
            
            <div class="signature">
                <p class="signature-line"></p>
                <p><strong>{{ $teacherName }}</strong><br>Teacher / Instruktur</p>
            </div>

        </div>
    </div>
</body>
</html>