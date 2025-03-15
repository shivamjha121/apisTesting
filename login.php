<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with OTP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        button:active {
            background-color: #388e3c;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login with OTP</h2>
        
        <!-- Send OTP Form -->
        <form id="otp-form" onsubmit="sendOtp(event)">
            <input type="text" id="email-phone" placeholder="Email or Phone No." required>
            <select id="userRole" >
                <option value="user">User</option>
                <option value="agent">Agent</option>
                <option value="builder">Builder</option>
            </select>
            <button type="submit">Send OTP</button>
        </form>

        <!-- Verify OTP Form (initially hidden) -->
        <form id="verify-otp-form" class="hidden" onsubmit="verifyOtp(event)">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" placeholder="Enter OTP" required>
            <button type="submit">Verify OTP</button>
        </form>
    </div>

</body>

<script>
    // const url = "http://localhost:8001/mapmyplot/apis/userAuth/sendOtp";
    const url = "http://65.0.201.115/mapmyplot/apis/userAuth/sendOtp";
    // const verifyUrl = "http://localhost:8001/mapmyplot/apis/userAuth/validateOtp";
    const verifyUrl = "http://65.0.201.115/mapmyplot/apis/userAuth/validateOtp";

    let userId = ''; // Variable to store user email or phone
    let userRole = '';

    const sendOtp = async (event) => {
        event.preventDefault(); // Prevent form submission and page reload
        try {
            userId = document.getElementById("email-phone").value; // Get user input (email/phone)
            userRole = document.getElementById("userRole").value;
            const response = await fetch(url + "?userId=" + userId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // Make sure to accept JSON responses
                },
                // body: JSON.stringify({ userId }) // Send userId in body
            });

            const data = await response.json();
            console.log(data, "data");

            if (data.status === 200) {
                // Hide Send OTP form and show Verify OTP form
                document.getElementById("otp-form").classList.add('hidden');
                document.getElementById("verify-otp-form").classList.remove('hidden');

                // Optionally, send an email to the user with the OTP (this would be done server-side)
                console.log("OTP sent successfully, please check your email/phone.");
            } else {
                alert("Failed to send OTP. Please try again.");
            }
        } catch (error) {
            console.error(error);
        }
    };

    const verifyOtp = async (event) => {
        event.preventDefault(); // Prevent form submission and page reload
        try {
            const otp = document.getElementById("otp").value; // Get OTP input
            const response = await fetch(verifyUrl + "?userId=" + userId + "&otp=" + otp + "&role=" + userRole, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // Make sure to accept JSON responses
                },
            });

            const data = await response.json();
            if (data.status === 200) {
                console.log(data);
                // Redirect to dashboard or other page after successful login
                alert("OTP verified successfully! You are logged in.");
            } else {
                alert("Invalid OTP. Please try again.");
            }
        } catch (error) {
            console.error(error);
        }
    };
</script>

</html>
