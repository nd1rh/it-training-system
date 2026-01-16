<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Course | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="animated-background">

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="container course-page" style="position: relative; z-index: 1;">
        <div class="edit-container">
            <div class="edit-card">
                <h1>Add New Course</h1>

                <!-- Validation Errors -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('configure/course/save') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="edit-content-wrapper">
                        <!-- Image Upload Section -->
                        <div class="photo-upload-section">
                            <img id="imagePreview"
                                class="edit-avatar-preview"
                                src="<?= base_url('uploads/courses/default.png') ?>"
                                alt="Course Image Preview">

                            <div class="upload-actions">
                                <label for="course_image" class="btn-change-photo">Choose Image</label>
                                <input type="file" name="course_image" id="course_image" accept="image/*" style="display: none;">
                                <br>
                                <small class="text-muted">Max 2MB</small>
                            </div>
                        </div>

                        <!-- Course Form Section -->
                        <div class="edit-form-section">
                            <div class="form-group mb-3">
                                <label>Course Name <span class="text-danger">*</span></label>
                                <input type="text" name="course_name" class="form-control"
                                    value="<?= set_value('course_name') ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="course_desc" class="form-control" rows="4" required><?= set_value('course_desc') ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Duration (Hours) <span class="text-danger">*</span></label>
                                <input type="number" name="course_duration" class="form-control"
                                    value="<?= set_value('course_duration') ?>" min="1" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Price (RM) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control"
                                    value="<?= set_value('price', 0) ?>" step="0.01" min="0" required>
                                <small class="text-muted">Enter 0 for free courses</small>
                            </div>

                            <div class="button-group d-flex justify-content-between">
                                <button type="submit" class="btn-save btn btn-success">
                                    <i class="fas fa-check me-1"></i> Save Course
                                </button>
                                <a href="<?= base_url('configure/course') ?>" class="btn-cancel btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Add background class
        $(document).ready(function() {
            $('body').addClass('animated-background');
        });

        // Live image preview
        document.getElementById('course_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert("File is too large! Max 2MB.");
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