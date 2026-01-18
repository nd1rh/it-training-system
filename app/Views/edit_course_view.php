<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Course | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="animated-background">

    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="container course-page" style="position: relative; z-index: 1;">
        <div class="edit-container">
            <div class="edit-card">
                <h1>Edit Course: <?= esc($course['course_name']) ?></h1>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('configure/course/update/' . $course['course_id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="edit-content-wrapper">
                        <div class="photo-upload-section">
                            <img id="imagePreview" 
                                 class="edit-avatar-preview" 
                                 src="<?= base_url($course['course_image'] ?: 'uploads/courses/default.png') ?>" 
                                 alt="Course Image Preview">
                            
                            <div class="upload-actions">
                                <label for="course_image" class="btn-change-photo">Change Image</label>
                                <input type="file" name="course_image" id="course_image" accept="image/*" style="display: none;">
                                <br>
                                <small class="text-muted">Max 2MB</small>
                            </div>
                        </div>

                        <div class="edit-form-section">
                            <div class="form-group">
                                <label>Course Name <span class="text-danger">*</span></label>
                                <input type="text" name="course_name" class="form-control" value="<?= esc($course['course_name']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="course_desc" class="form-control" rows="4" required><?= esc($course['course_desc']) ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Duration (Hours) <span class="text-danger">*</span></label>
                                <input type="number" name="course_duration" class="form-control" value="<?= esc($course['course_duration']) ?>" min="1" required>
                            </div>

                            <div class="form-group">
                                <label>Price (RM) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" value="<?= esc($course['price']) ?>" step="0.01" min="0" required>
                                <small class="text-muted">Enter 0 for free courses</small>
                            </div>

                            <div class="button-group">
                                <button type="submit" class="btn-save">Save Changes</button>
                                <a href="<?= base_url('configure/course') ?>" class="btn-cancel">Cancel and Go Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('animated-background');
        });
    </script>
    <script>
        document.getElementById('course_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert("File is too large! Please select an image under 2MB.");
                    this.value = "";
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>

