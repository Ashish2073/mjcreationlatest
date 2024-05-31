@extends('managedashboard.layout.main')
@section('title', 'Vendor profile')
@section('content')
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 20px;
        }

        .profile-image-card,
        .form-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 100%;
            max-width: 400px;
        }

        .profile-image-card {
            flex: 1 1 30%;
            text-align: center;
        }

        .profile-image-card img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-image-card input {
            display: block;
            margin: 10px auto;
        }

        .form-cards {
            flex: 1 1 60%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .form-card {
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 0;
        }

        .form-group {
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            align-self: flex-end;
        }

        button:hover {
            background-color: #45a049;
        }

        .upload-area {
            width: 100%;
            max-width: 17rem;
            background-color: var(--clr-white);
            box-shadow: 0 10px 60px rgb(218, 229, 255);
            border: 2px solid var(--clr-light-blue);
            border-radius: 24px;
            padding: 2rem 1.875rem 5rem 1.875rem;
            margin: 0.625rem;
            text-align: center;
        }

        .upload-area--open {
            /* Slid Down Animation */
            animation: slidDown 500ms ease-in-out;
        }

        @keyframes slidDown {
            from {
                height: 28.125rem;
                /* 450px */
            }

            to {
                height: 35rem;
                /* 560px */
            }
        }

        .upload-area__paragraph {
            font-size: 0.9375rem;
            color: gray;
            margin-top: 0;
        }

        .upload-area__tooltip {
            position: relative;
            color: lightskyblue;
            cursor: pointer;
            transition: color 300ms ease-in-out;
        }

        .upload-area__tooltip:hover {
            color: var(--clr-blue);
        }

        .upload-area__tooltip-data {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -125%);
            min-width: max-content;
            background-color: white;
            color: blue;
            border: 1px solid lightblue;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            opacity: 0;
            visibility: hidden;
            transition: none 300ms ease-in-out;
            transition-property: opacity, visibility;
        }

        .upload-area__tooltip:hover .upload-area__tooltip-data {
            opacity: 1;
            visibility: visible;
        }

        /* Drop Zoon */
        .upload-area__drop-zoon {
            position: relative;
            height: 4.25rem;
            /* 180px */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 2px dashed lightblue;
            border-radius: 15px;
            margin-top: 2.1875rem;
            cursor: pointer;
            transition: border-color 300ms ease-in-out;
        }

        .upload-area__drop-zoon:hover {
            border-color: blue;
        }

        .drop-zoon__icon {
            display: flex;
            font-size: 3.75rem;
            color: blue;
            transition: opacity 300ms ease-in-out;
        }

        .drop-zoon__paragraph {
            font-size: 0.9375rem;
            color: rgb(15, 15, 15);
            margin: 0;
            margin-top: 0.625rem;
            transition: opacity 300ms ease-in-out;
        }

        .drop-zoon:hover .drop-zoon__icon,
        .drop-zoon:hover .drop-zoon__paragraph {
            opacity: 0.7;
        }

        .drop-zoon__loading-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            color: lightblue;
            z-index: 10;
        }

        .drop-zoon__preview-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 0.3125rem;
            border-radius: 10px;
            display: none;
            z-index: 1000;
            transition: opacity 300ms ease-in-out;
        }

        .drop-zoon:hover .drop-zoon__preview-image {
            opacity: 0.8;
        }

        .drop_zoon_file-input-edit {
            display: none;
        }

        /* (drop-zoon--over) Modifier Class */
        .drop-zoon--over {
            border-color: blue;
        }

        .drop-zoon--over .drop-zoon__icon,
        .drop-zoon--over .drop-zoon__paragraph {
            opacity: 0.7;
        }

        .drop-zoon--Uploaded .drop-zoon__icon,
        .drop-zoon--Uploaded .drop-zoon__paragraph {
            display: none;
        }

        /* File Details Area */
        .upload-area__file-details {
            height: 0;
            visibility: hidden;
            opacity: 0;
            text-align: left;
            transition: none 500ms ease-in-out;
            transition-property: opacity, visibility;
            transition-delay: 500ms;
        }

        /* (duploaded-file--open) Modifier Class */
        .file-details--open {
            height: auto;
            visibility: visible;
            opacity: 1;
        }

        .file-details__title {
            font-size: 1.125rem;
            font-weight: 500;
            color: gray;
        }

        /* Uploaded File */
        .uploaded-file {
            display: flex;
            align-items: center;
            padding: 0.625rem 0;
            visibility: hidden;
            opacity: 0;
            transition: none 500ms ease-in-out;
            transition-property: visibility, opacity;
        }

        /* (duploaded-file--open) Modifier Class */
        .uploaded-file--open {
            visibility: visible;
            opacity: 1;
        }

        .uploaded-file__icon-container {
            position: relative;
            margin-right: 0.3125rem;
        }

        .uploaded-file__icon {
            font-size: 3.4375rem;
            color: blue;
        }

        .uploaded-file__icon-text {
            position: absolute;
            top: 1.5625rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.9375rem;
            font-weight: 500;
            color: white;
        }

        .uploaded-file__info {
            position: relative;
            top: -0.3125rem;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .uploaded-file__info::before,
        .uploaded-file__info::after {
            content: "";
            position: absolute;
            bottom: -0.9375rem;
            width: 0;
            height: 0.5rem;
            background-color: #ebf2ff;
            border-radius: 0.625rem;
        }

        .uploaded-file__info::before {
            width: 100%;
        }

        .uploaded-file__info::after {
            width: 100%;
            background-color: blue;
        }

        /* Progress Animation */
        .uploaded-file__info--active::after {
            animation: progressMove 800ms ease-in-out;
            animation-delay: 300ms;
        }

        @keyframes progressMove {
            from {
                width: 0%;
                background-color: transparent;
            }

            to {
                width: 100%;
                background-color: blue;
            }
        }

        .uploaded-file__name {
            width: 100%;
            max-width: 6.25rem;
            /* 100px */
            display: inline-block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .uploaded-file__counter {
            font-size: 1rem;
            color: gray;
        }
    </style>

    <div class="container">
        <div class="profile-image-card">
            {{-- <h2>Profile Picture</h2>
            <img id="profileImage" src="default-profile.png" alt="Profile Image">
            <input type="file" id="imageUpload" accept="image/*"> --}}

            <div class="form-group">
                <label for="coupon-code">Image</label>
                <div id="uploadArea" class="upload-area">
                    <!-- Header -->
                    <div class="upload-area__header">
                        <p class="upload-area__paragraph">
                            File should be an image
                            <strong class="upload-area__tooltip">
                                Like
                                <span class="upload-area__tooltip-data"></span>
                                <!-- Data Will be Comes From Js -->
                            </strong>
                        </p>
                    </div>
                    <!-- End Header -->

                    <!-- Drop Zoon -->





                    <div id="dropZoonEdit" class="upload-area__drop-zoon drop-zoon">
                        <span class="drop-zoon__icon">
                            <i class="bx bxs-file-image"></i>
                        </span>
                        <p class="drop-zoon__paragraph">Upload Image</p>
                        <span id="loadingTextEdit" class="drop-zoon__loading-text">Please
                            Wait</span>
                        <img src="" alt="Preview Image" id="previewImageedit" class="drop-zoon__preview-image"
                            draggable="false" style="display: none" />

                        <input type="file" id="discount_banner_image_edit" name="discount_banner_image_edit"
                            class="drop_zoon_file-input-edit" style="display:none"
                            accept="image/jpeg,image/png,image/svg+xml,image/gif" />
                    </div>
                    <!-- End Drop Zoon -->

                    <!-- File Details -->
                    <div id="fileDetailsEdit" class="upload-area__file-details file-details">
                        <div id="uploadedFileEdit" class="uploaded-file">
                            <div class="uploaded-file__icon-container">
                                <i class="bx bxs-file-blank uploaded-file__icon"></i>
                                <span class="uploaded-file__icon-text"></span>
                                <!-- Data Will be Comes From Js -->
                            </div>

                            <div id="uploadedFileEditInfoedit" class="uploaded-file__info">
                                <span class="uploaded-file__name">Proejct 1</span>
                                <span class="uploaded-file__counter">0%</span>
                            </div>
                        </div>
                    </div>

                    <span id="discount_banner_image_error_edit" style="color: #ff0000"></span>


                    <!-- End File Details -->

                </div>

                {{-- <div class="plus-icn">
                    <i class="fa fa-plus-square"></i>
                </div> --}}

            </div>







        </div>
        <div class="form-cards">
            <div class="form-card">
                <h2>Personal Information</h2>
                <form id="personalInfoForm">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </form>
            </div>
            <div class="form-card">
                <h2>Change Password</h2>
                <form id="changePasswordForm">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>
                </form>
            </div>
            <div class="form-card">
                <h2>Bio</h2>
                <form id="bioForm">
                    <div class="form-group">
                        <label for="bio">Bio:</label>
                        <textarea id="bio" name="bio" rows="4" required></textarea>
                    </div>
                </form>
            </div>
            <button type="submit" form="personalInfoForm" form="changePasswordForm" form="bioForm">Save Changes</button>
        </div>
    </div>
@endsection

@section('page-script')

    <script>
        ProfileEdit();

        function ProfileEdit() {


            const uploadArea = document.querySelector("#uploadArea");

            // Select Drop-Zoon Area
            const dropZoonEdit = document.querySelector("#dropZoonEdit");

            // Loading Text
            const loadingTextEdit = document.querySelector("#loadingTextEdit");

            // Slect File Input
            const discount_banner_image_edit = document.querySelector("#discount_banner_image_edit");

            // Select Preview Image
            const previewImageedit = document.querySelector("#previewImageedit");

            // File-Details Area
            const fileDetailsEdit = document.querySelector("#fileDetailsEdit");

            // Uploaded File
            const uploadedFileEdit = document.querySelector("#uploadedFileEdit");

            // Uploaded File Info
            const uploadedFileEditInfoedit = document.querySelector("#uploadedFileEditInfoedit");

            // Uploaded File  Name
            const uploadedFileEditName = document.querySelector(".uploaded-file__name");

            // Uploaded File Icon
            const uploadedFileEditIconText = document.querySelector(
                ".uploaded-file__icon-text"
            );

            // Uploaded File Counter
            const uploadedFileEditCounter = document.querySelector(
                ".uploaded-file__counter"
            );

            // ToolTip Data
            const toolTipData = document.querySelector(".upload-area__tooltip-data");

            // Images Types
            const imagesTypes = ["jpeg", "png", "svg", "gif"];

            // Append Images Types Array Inisde Tooltip Data
            toolTipData.innerHTML = [...imagesTypes].join(", .");

            // When (drop-zoon) has (dragover) Event
            dropZoonEdit.addEventListener("dragover", function(event) {
                // Prevent Default Behavior
                event.preventDefault();

                // Add Class (drop-zoon--over) On (drop-zoon)
                dropZoonEdit.classList.add("drop-zoon--over");
            });

            // When (drop-zoon) has (dragleave) Event
            dropZoonEdit.addEventListener("dragleave", function(event) {
                // Remove Class (drop-zoon--over) from (drop-zoon)
                dropZoonEdit.classList.remove("drop-zoon--over");
            });

            // When (drop-zoon) has (drop) Event
            dropZoonEdit.addEventListener("drop", function(event) {
                // Prevent Default Behavior
                event.preventDefault();

                // Remove Class (drop-zoon--over) from (drop-zoon)
                dropZoonEdit.classList.remove("drop-zoon--over");

                // Select The Dropped File
                const file = event.dataTransfer.files[0];

                // Call Function uploadFile(), And Send To Her The Dropped File :)
                uploadFile(file);
            });

            // When (drop-zoon) has (click) Event
            dropZoonEdit.addEventListener("click", function(event) {
                // Click The (discount_banner_image_edit)
                discount_banner_image_edit.click();
            });

            // When (discount_banner_image_edit) has (change) Event
            discount_banner_image_edit.addEventListener("change", function(event) {
                // Select The Chosen File
                const file = event.target.files[0];

                // Call Function uploadFile(), And Send To Her The Chosen File :)
                uploadFile(file);
            });

            // Upload File Function
            function uploadFile(file) {
                // FileReader()
                const fileReader = new FileReader();
                // File Type
                const fileType = file.type;
                // File Size
                const fileSize = file.size;

                // If File Is Passed from the (File Validation) Function
                if (fileValidate(fileType, fileSize)) {
                    // Add Class (drop-zoon--Uploaded) on (drop-zoon)
                    dropZoonEdit.classList.add("drop-zoon--Uploaded");

                    // Show Loading-text
                    loadingTextEdit.style.display = "block";
                    // Hide Preview Image
                    previewImageedit.style.display = "none";

                    // Remove Class (uploaded-file--open) From (uploadedFileEdit)
                    uploadedFileEdit.classList.remove("uploaded-file--open");
                    // Remove Class (uploaded-file__info--active) from (uploadedFileEditInfoedit)
                    uploadedFileEditInfoedit.classList.remove("uploaded-file__info--active");

                    // After File Reader Loaded
                    fileReader.addEventListener("load", function() {
                        // After Half Second
                        setTimeout(function() {
                            // Add Class (upload-area--open) On (uploadArea)
                            uploadArea.classList.add("upload-area--open");

                            // Hide Loading-text (please-wait) Element
                            loadingTextEdit.style.display = "none";
                            // Show Preview Image
                            previewImageedit.style.display = "block";

                            // Add Class (file-details--open) On (fileDetailsEdit)
                            fileDetailsEdit.classList.add("file-details--open");
                            // Add Class (uploaded-file--open) On (uploadedFileEdit)
                            uploadedFileEdit.classList.add("uploaded-file--open");
                            // Add Class (uploaded-file__info--active) On (uploadedFileEditInfoedit)
                            uploadedFileEditInfoedit.classList.add("uploaded-file__info--active");
                        }, 500); // 0.5s

                        // Add The (fileReader) Result Inside (previewImageedit) Source
                        previewImageedit.setAttribute("src", fileReader.result);

                        // Add File Name Inside Uploaded File Name
                        uploadedFileEditName.innerHTML = file.name;

                        // Call Function progressMove();
                        progressMove();
                    });

                    // Read (file) As Data Url
                    fileReader.readAsDataURL(file);
                } else {
                    // Else

                    this; // (this) Represent The fileValidate(fileType, fileSize) Function
                }
            }

            // Progress Counter Increase Function
            function progressMove() {
                // Counter Start
                let counter = 0;

                // After 600ms
                setTimeout(() => {
                    // Every 100ms
                    let counterIncrease = setInterval(() => {
                        // If (counter) is equle 100
                        if (counter === 100) {
                            // Stop (Counter Increase)
                            clearInterval(counterIncrease);
                        } else {
                            // Else
                            // plus 10 on counter
                            counter = counter + 10;
                            // add (counter) vlaue inisde (uploadedFileEditCounter)
                            uploadedFileEditCounter.innerHTML = `${counter}%`;
                        }
                    }, 100);
                }, 600);
            }

            // Simple File Validate Function
            function fileValidate(fileType, fileSize) {
                // File Type Validation
                let isImage = imagesTypes.filter(
                    (type) => fileType.indexOf(`image/${type}`) !== -1
                );

                // If The Uploaded File Type Is 'jpeg'
                if (isImage[0] === "jpeg") {
                    // Add Inisde (uploadedFileEditIconText) The (jpg) Value
                    uploadedFileEditIconText.innerHTML = "jpg";
                } else {
                    // else
                    // Add Inisde (uploadedFileEditIconText) The Uploaded File Type
                    uploadedFileEditIconText.innerHTML = isImage[0];
                }

                // If The Uploaded File Is An Image
                if (isImage.length !== 0) {
                    // Check, If File Size Is 2MB or Less
                    if (fileSize <= 2000000) {
                        // 2MB :)
                        return true;
                    } else {
                        // Else File Size
                        return alert("Please Your File Should be 2 Megabytes or Less");
                    }
                } else {
                    // Else File Type
                    return alert("Please make sure to upload An Image File Type");
                }


            }


        }
    </script>


@endsection
