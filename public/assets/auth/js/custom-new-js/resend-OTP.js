function startCountdown() {
    var countdown = 10; // Set initial countdown value
    var timer = setInterval(() => {
        countdown--;
        document.getElementById('resend-otp').innerText = `Resend OTP in ${countdown}s`;
        if (countdown <= 0) {
            clearInterval(timer);
            var resendOtpButton = document.getElementById('resend-otp');
            resendOtpButton.disabled = false; // Enable the button after countdown
            resendOtpButton.innerText = 'Resend OTP'; // Set the button text
            resendOtpButton.style.color = '#ffff'; // Set the text color
            resendOtpButton.style.backgroundColor = '#9E6DE0'; // Set the background color
        }
    }, 1000); // Decrease countdown every second
}

document.getElementById('resend-otp-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission
    console.log('click');
    const mobile = document.querySelector('input[name="mobile"]').value;
    const ResendOTP = document.querySelector('input[name="ResendOTP"]').value;
    
    console.log('Mobile:', mobile);
    console.log('ResendOTP:', ResendOTP);

    fetch(RESEND_OTP_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        body: JSON.stringify({
            mobile: mobile,
            ResendOTP: ResendOTP
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Response Data:', data);
        document.getElementById('send-otp-success')?.remove();
        document.getElementById('send-otp-error')?.remove();
        const alertContainer = document.getElementById('alert-container-resend');
        alertContainer.innerHTML = ''; // Clear previous alerts

        if (data.success) {
            alertContainer.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${data.message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;
            setTimeout(() => {
                const successAlert = document.getElementById('alert-container-resend');
                if (successAlert) {
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade');
                }
            }, 5000);

            document.getElementById('resend-otp').disabled = true; // Disable the button again
            startCountdown(); // Start the countdown
        } else {
            alertContainer.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${data.error}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        const alertContainer = document.getElementById('alert-container-resend');
        alertContainer.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                An error occurred. Please try again.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
    });
});

// Initial countdown
startCountdown();
