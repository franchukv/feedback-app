<?php include 'inc/header.php'; ?>

<?php 
    $sql = 'SELECT * FROM feedback';
    $result = mysqli_query($conn, $sql);
    $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<main>
    <div class="feedback-container">   
        <h2>Feedback</h2>

        <?php if(empty($feedback)): ?>
                <h3>There is no feedback</h3>
        <?php endif; ?>

        <?php foreach($feedback as $item): ?>
            <div class="feedback-item">
                <span><?php echo $item['name']; ?></span>
                <p>
                    <?php echo $item['body']; ?>
                </p>
                <span><?php echo $item['date']; ?></span>
            </div>
        <?php endforeach; ?>

    </div>
</main>

<?php include 'inc/footer.php'; ?>