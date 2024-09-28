
ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        console.log(editor);
    })/* 
    .catch(error => {
        console.error(error);
    }) */;



$(document).ready(function () {
    $('#toggleIcon').click(function () {
        $('.sidebar').toggleClass('close');
    });
});



// create-invoice
$(document).ready(function () {
    /* $('.add-more').hide(); */
    $('.remove-item').show();

    // Show "Add" button only for the first row
    /* $('.invoice-item:first .add-more').show(); */
    $('.invoice-item:first .remove-item').hide();
    // Add more rows when the "Add More" button is clicked
    $("#add-more").click(function () {
        var newRow = $(".invoice-item:first, .description-item:first").clone();
        newRow.find("input, textarea").val(""); // Clear the values in the cloned row
        var removeButton =
            '<button type="button" class="remove-item" rowspan="2"><i class="fa-solid fa-xmark"></i></button>';
        newRow.filter('.invoice-item').find("td:last").attr("rowspan", "2").html(removeButton);
        $(".description-item:last").after(newRow);
    });

    // Remove Button Click Event using Event Delegation
    $("#invoice-table").on("click", ".remove-item", function () {
        var currentRow = $(this).closest("tr");
        var nextRow = currentRow.next();

        // Remove both the current row and the next row
        currentRow.remove();
        nextRow.remove();

        updateTotalAmount(); // Update this function based on your logic
    });
    // Calculate amount on quantity change
    $(document).on("change", ".quantity", function () {
        updateRowAmount($(this).closest("tr"));
        updateTotalAmount();
    });

    // Calculate amount on price change
    $(document).on("change", ".price", function () {
        updateRowAmount($(this).closest("tr"));
        updateTotalAmount();
    });

    // Calculate amount on discount or tax change
    $(document).on("change", ".discount, .tax", function () {
        updateTotalAmount();
    });
});

// Function to update the total amount for each row
function updateRowAmount(row) {
    var quantity = parseFloat(row.find(".quantity").val()) || 0;
    var price = parseFloat(row.find(".price").val()) || 0;
    var amount = quantity * price;
    row.find(".amount").val(amount.toFixed(2));
}

// Function to update the total amount in the last row
function updateTotalAmount() {
    var totalAmount = 0;

    $(".invoice-item").each(function () {
        var amount = parseFloat($(this).find(".amount").val()) || 0;
        totalAmount += amount;
    });

    // Update the total amount in the last row
    $(".sub-total-amount").text(totalAmount.toFixed(2));
    $(".subtotal").val(totalAmount.toFixed(2));

    var discount = parseFloat($(".discount").val()) || 0;
    var tax = parseFloat($(".tax").val()) || 0;

    totalAmount = totalAmount - discount + tax;

    // Update the total amount in the last row
    $(".total-amount").text(totalAmount.toFixed(2));
    $(".totalamount").val(totalAmount.toFixed(2));
}

$(document).ready(function () {
    $('#logo').change(function () {
        previewImage();
    });

    function previewImage() {
        var input = $('#logo')[0];
        var preview = $('#preview')[0];

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                if (input.files[0].type === 'application/pdf') {
                    // If the file is a PDF, set a default PDF logo
                    $(preview).attr('src', "{{ asset('public/images/pdf.png ') }}").width(100);
                } else {
                    // For other file types, display the uploaded image
                    $(preview).attr('src', e.target.result).width(200);
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});
/* $(document).ready(function () {
    $('#document').change(function () {
        previewImages(this);
    });

    function previewImages(input) {
        var previewContainer = $('#preview-container');
        previewContainer.empty(); // Clear previous previews

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = (function (file) {
                    return function (e) {
                        var fileType = file.type;

                        var previewElement = $('<div></div>');

                        if (fileType === 'application/pdf') {
                            // If the file is a PDF, set a default PDF logo
                            previewElement.append("<img src='{{ asset('public/images/pdf.png') }}' alt='PDF' width='100'>");
                        } else {
                            // For other file types, display the uploaded image
                            previewElement.append('<img src="' + e.target.result +
                                '" alt="Image" width="200">');
                        }

                        previewContainer.append(previewElement);
                    };
                })(input.files[i]);

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
}); */

$(document).ready(function () {
    $('#customerDropdown').change(function () {
        var selectedOption = $(this).find(':selected');
        var mobileValue = selectedOption.data('mobile');
        var gmailValue = selectedOption.data('gmail');
        var companyValue = selectedOption.data('company');
        $('#mobilenumber').text(mobileValue);
        $('#gmail').text(gmailValue);
        $('#company').text(companyValue);
    });

    $('#selectCurrency').change(function () {
        var selectedOption = $(this).find(':selected');
        var mobileValue = selectedOption.data('symbol');
        $('.currency').text(mobileValue);
    });
});

$('#invoice-datatable').DataTable();
$('#customer-table').DataTable();

// invoice

$(function () {
    $('.selectpicker').selectpicker();
});

/* document.addEventListener('DOMContentLoaded', function () {
    const body = document.getElementById('mainBody');
    const menuBtn = document.querySelector('.menu-btn.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (body && menuBtn && sidebar) {
        menuBtn.addEventListener('click', function () {
            body.classList.toggle('sidebar-open');
            sidebar.classList.toggle('active');
        });
    } else {
        console.error("One or more elements not found.");
    }
}); */

/*    $(document).ready(function() {
       // Handle clicking on a notification
       $('.dropdown-menu').on('click', 'li', function() {
           var notificationId = $(this).data('notification-id');
           alert(notificationId);
           // Perform AJAX request to mark the notification as read
           $.ajax({
               url: '/mark-notification-as-read/' + notificationId,
               method: 'POST',
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(response) {
                   // Update the notification count
                   $('.number').text(response.unread_count);

                   // Remove the clicked notification from the dropdown
                   $(this).remove();
               },
               error: function(xhr, status, error) {
                   console.error(xhr.responseText);
               }
           });
       });
   }); */




/*  phone input field */
/* $(document).ready(function () {
    // Initialize intlTelInput plugin
    $("input[type='tel']").intlTelInput({
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
}); */

var mobile = window.intlTelInput(document.querySelector("#mobile"), {
    separateDialCode: true,
    hiddenInput: "full",
    utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
  });
  
  $("form").submit(function() {
    var fullnumber = mobile.getNumber(intlTelInputUtils.numberFormat.E164);
  $("input[name='mobile[full]'").val(fullnumber);
    // alert(fullnumber)
    
  });
var phone_number = window.intlTelInput(document.querySelector("#company_mobile"), {
    separateDialCode: true,
    hiddenInput: "full",
    utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
  });
  
  $("form").submit(function() {
    var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
  $("input[name='phone_number[full]'").val(full_number);
    // alert(full_number)
    
  });
