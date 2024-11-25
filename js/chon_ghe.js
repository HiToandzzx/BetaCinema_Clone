const prices = {
    "vip": 70000,     
    "couple": 120000, 
    "regular": 45000  
};

let totalPrice = null;
let selectedSeats = []; 
const maxSeats = 5; 

// Hàm cập nhật hiển thị giá và ghế
function updateDisplay(seatType, seatNumber, action) {
    if (action === 'add') {
        selectedSeats.push(seatNumber);
        if (seatType === 'vip') {
            totalPrice += prices.vip;
        } else if (seatType === 'couple') {
            totalPrice += prices.couple;
        } else if (seatType === 'regular') {
            totalPrice += prices.regular;
        }
    } else if (action === 'remove') {
        selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
        if (seatType === 'vip') {
            totalPrice -= prices.vip;
        } else if (seatType === 'couple') {
            totalPrice -= prices.couple;
        } else if (seatType === 'regular') {
            totalPrice -= prices.regular;
        }
    }

    // Cập nhật hiển thị tổng giá và danh sách ghế đã chọn
    document.getElementById("total-price").innerText = totalPrice.toLocaleString() + " VNĐ";
    document.getElementById("selected-seats").innerText = selectedSeats.join(", ");

    // Cập nhật vào input của form
    document.getElementById('total-price-input').value = totalPrice;
    document.getElementById('selected-seats-input').value = selectedSeats.join(', ');
}

// Hàm xử lý chọn/bỏ chọn ghế với giới hạn số ghế
function toggleSeat(button, seatType, seatNumber) {
    if (button.classList.contains("selected")) {
        // Hủy chọn ghế
        button.classList.remove("selected");
        updateDisplay(seatType, seatNumber, 'remove');
    } else {
        // Kiểm tra giới hạn số ghế
        if (selectedSeats.length >= maxSeats) {
            alert("Bạn chỉ có thể chọn tối đa " + maxSeats + " ghế.");
            return;
        }
        // Chọn ghế
        button.classList.add("selected");
        updateDisplay(seatType, seatNumber, 'add');
    }
}

// ĐẾM NGƯỢC 10P
let countdownTime = 600; 

function updateCountdown() {
    const minutes = Math.floor(countdownTime / 60);
    const seconds = countdownTime % 60;

    document.getElementById('countdown-timer').textContent = 
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

    if (countdownTime === 0) {
        clearInterval(timerInterval); 
        window.location.href = 'index.php'; 
    }

    countdownTime--; 
}

const timerInterval = setInterval(updateCountdown, 1000);


/* XỬ LÍ TRƯỚC KHI GỬI FORM */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const selectedSeatsInput = document.getElementById('selected-seats-input');
    
    form.addEventListener('submit', function(event) {
        if (selectedSeatsInput.value.trim() === "") {
            event.preventDefault();
            
            alert("Vui lòng chọn ít nhất một ghế.");
        }
    });
});