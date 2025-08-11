<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="../public/assets/css/crudPost-form.css" />
    <title>CMS-Project</title>
</head>

<body>
    <div class="form-container">
        <h2>Post Creation</h2>
        <form action="<?= BASE_URL ?>/createPost-form" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label>Image <span>*</span></label>
                    <input type="file" name="image" required />
                </div>
                <div class="form-group">
                    <label>Title <span>*</span></label>
                    <input type="text" name="title" placeholder="Enter the title" required />
                </div>
            </div>

            <div class="form-group">
                <label>Content<span>*</span></label>
                <textarea name="body" rows="4" placeholder="Lorem ipsum" required></textarea>
            </div>

            <div class="button-row">
                <a href="<?= BASE_URL ?>/admin-dashboard" class="back-btn">Back</a>
                <button class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>