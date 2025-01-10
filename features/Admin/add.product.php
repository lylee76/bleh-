<?php include('partials/header.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h2>Add Product</h2>
        <br><br>
        <!-- Add product form starts here-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="Title" placeholder="Enter Product name" required>
                    </td>
                </tr>
                <tr>
                    <td>description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the product." required></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>
                <tr>
                    <td>Product Image:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Product Category:</td>
                    <td>
                        <select name="category">
                            <option value="1">Indoor Plants</option>
                            <option value="2">Outdoor Plants</option>
                        </select>
                    </td>
                </tr>
                <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name="featured" value="yes">Yes
                <input type="radio" name="featured" value="no">No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="Active" value="yes">Yes
                <input type="radio" name="Active" value="no">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Product " class="btn-secondary">
            </td>
        </tr>

        </form>
        <!-- Add product form ends here-->
    </div>
</div>

<?php include('partials/footer.php');?>

