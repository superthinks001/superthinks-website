{\rtf1\ansi\ansicpg1252\cocoartf2821
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0

\f0\fs24 \cf0 <?php\
if ($_SERVER["REQUEST_METHOD"] == "POST") \{\
    $first_name = htmlspecialchars($_POST["first_name"]);\
    $last_name = htmlspecialchars($_POST["last_name"]);\
    $email = htmlspecialchars($_POST["email"]);\
    $message = htmlspecialchars($_POST["message"]);\
\
    $to = "contact@superthinks.ai";  // Change this to your real email\
    $subject = "New Contact Form Submission from $first_name $last_name";\
    $headers = "From: $email" . "\\r\\n" . "Reply-To: $email";\
\
    $body = "Name: $first_name $last_name\\n";\
    $body .= "Email: $email\\n\\n";\
    $body .= "Message:\\n$message\\n";\
\
    if (mail($to, $subject, $body, $headers)) \{\
        echo "success";\
    \} else \{\
        echo "error";\
    \}\
\} else \{\
    echo "error";\
\}\
?>}