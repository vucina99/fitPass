<div class="container pt-5">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <?php

            if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <form action="index.php?page=routes&createUser" method="post">
                <div class="form-group">
                    <label for="name">name :</label><br>
                    <input type="text" id="name" class="form-control" name="name" placeholder="your name">
                </div>
                <div class="form-group">
                    <label for="birthday">birthday :</label><br>
                    <input type="date" id="birthday" class="form-control" name="birthday" placeholder="your birthday">
                </div>
                <br><br>
                <input type="submit" class="btn btn-primary w-100" value="CREATE"><br><br>
                <a href="/web/index.php"> <input type="button" class="btn btn-primary w-100"
                                                 value="GO BACK TO THE LIST"></a>
            </form>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

