<?php

$database = connectToDB();
    
// 3. get the students data from the database
  // 3.1 - SQL command (recipe)
  $sql = "SELECT * FROM todos";
  // 3.2 - prepare sql query (prepare your material)
  $query = $database->prepare( $sql );
  // 3.3 - execute sql query (cook it)
  $query->execute();
  // 3.4 - fetch all the results from query (eat)
  $todos = $query->fetchAll();


?>
<?php require "parts/header.php"; ?>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <!--if user is logged in-->
          <p>Hello, <?= $_SESSION["user"]["name"]; ?></p>

        <ul class="list-group">
        <?php
        foreach ($todos as $index => $todo) { ?>
        
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
                <form 
                method="POST"
                action="/task/completed">
                <input type="hidden" name="todo_completed" value="<?php echo $todo["completed"] ?>">
                <input type="hidden" name="todo_id" value="<?php echo $todo["id"] ?>">

                <?php if ($todo["completed"]==0) {?>
                    <button class="btn btn-sm btn-white">
                    <i class="bi bi-square"></i>
                    </button>
                    <span class="ms-2"><?php echo $todo["label"]; ?></span>

                <?php } else { ?>
                    <button class="btn btn-sm btn-success">
                    <i class="bi bi-check-square"></i>
                    </button>
                    <span class="ms-2 text-decoration-line-through"><?php echo $todo["label"]; ?></span>
                <?php } ?>
                </form>
            </div>
            <div>
            <form 
          method="POST" 
          action="/task/delete">
        <!--hidde input is to pass required data to the backend-->
            <input type="hidden" name="todo_id" value="<?php echo $todo["id"]; ?>" />
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
        </form>
            </div>
          </li>
<?php } ?>
        
        </ul>
        <div class="mt-4">
          <form method="POST" action="/task/add" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="todo_label"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>

        <?php else: ?>
          <!-- If user is not logged in -->
          <div>
            <a href="/login">Login</a>
            <a href="/signup">Sign Up</a>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ( isset( $_SESSION["user"] ) ) : ?>
          <div class="text-center">
            <a href="/logout">Logout</a>
          </div>
    <?php endif; ?>

    <?php require "parts/footer.php"; ?>