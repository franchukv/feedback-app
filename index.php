<?php include 'inc/header.php'; ?>

<?php 
    $name = $email = $body = '';
    $nameError = $emailError = $bodyError = '';

    // Form submit
    if(isset($_POST['submit'])) {

        // Validate name
        if(empty($_POST['name'])) {
            $nameError = 'Name is required';
        } else {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        // Validate email
        if(empty($_POST['email'])) {
            $emailError = 'Email is required';
        } else {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        }

        // Validate body
        if(empty($_POST['body'])) {
            $bodyError = 'Feedback is required';
        } else {
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if(empty($nameError) && empty($emailError) && empty($bodyError)) {
            // Add to database
            $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";

            if(mysqli_query($conn, $sql)) {
                // Success
                header('Location: feedback.php');
            } else {
                // Error
                echo 'Error ' . mysqli_error($conn);
            }
        }
    }
?>

<main>
  <div>
    <h2>Feedback</h2>
    <p>Leave your feedback</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="name">
            Name
            <span><?php echo $nameError; ?></span>
            <input class="<?php echo $nameError ? 'is-invalid' : null; ?>" type="text" id="name" name="name" placeholder="Enter your name">
        </label>

        <label for="email">
            Email
            <span><?php echo $emailError; ?></span>
            <input class="<?php echo $emailError ? 'is-invalid' : null; ?>" type="email" id="email" name="email" placeholder="Enter your email">
        </label> 

        <label for="body" class="form-label">
            Feedback
            <span><?php echo $bodyError; ?></span>
            <textarea class="<?php echo $bodyError ? 'is-invalid' : null; ?>" name="body" placeholder="Enter your feedback"></textarea>
        </label>

        <input type="submit" name="submit" value="Send">
    </form>
    </div>
</main>

<?php include 'inc/footer.php'; ?>