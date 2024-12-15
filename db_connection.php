<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #9fbff0;
        }
        .login-container {
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0px 4px 12px rgba(43, 17, 17, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-size: 14px;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .register-link {
            margin-top: 15px;
            font-size: 14px;
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
        .register-link:hover {
            color: #0056b3;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 10px;
            display: none;
        }
    </style>