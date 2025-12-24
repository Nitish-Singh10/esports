@extends('dasboard')

@section('title', 'Add Players')

@section('section')
    <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">

            <form action={{url('/submit')}} method="POST">
                @csrf
                <div class="formbold-form-title">
                    <h2 class="">Register now</h2>
                </div>

                <div class="formbold-input-flex">
                    <div>
                        <label class="formbold-form-label">Game</label>
                        <select name="game" id="game" class="formbold-form-input" required>
                            <option value="">Select Game</option>
                            <option value="FREE_FIRE">Free Fire</option>
                            <option value="BGMI">BGMI</option>
                            <option value="COD">COD Mobile</option>
                            <option value="VALORANT">Valorant</option>
                            <option value="EFOOTBALL">E Football</option>
                            <option value="CLASH_ROYALE">Clash Royale</option>
                        </select>
                    </div>

                    <div>
                        <label class="formbold-form-label">Category</label>
                        <select name="category" id="category" class="formbold-form-input" required>
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>


                <div class="formbold-input-flex">
                    <div>
                        <label for="fullname" class="formbold-form-label"> Full Name </label>
                        <input type="text" name="fullname" class="formbold-form-input" />
                    </div>
                    <div>
                        <label for="class" class="formbold-form-label"> Class </label>
                        <input type="text" name="class" class="formbold-form-input" />
                    </div>
                </div>

                <div class="formbold-input-flex">
                    <div>
                        <label for="rollno" class="formbold-form-label"> Roll No </label>
                        <input type="text" name="rollno" class="formbold-form-input" />
                    </div>
                    <div>
                        <label for="phoneno" class="formbold-form-label"> Phone No </label>
                        <input type="text" name="phoneno" class="formbold-form-input" />
                    </div>
                </div>


                <div class="formbold-input-flex">
                    <div>
                        <label for="email" class="formbold-form-label"> Email </label>
                        <input type="email" name="email" class="formbold-form-input" />
                    </div>
                    <div>
                        <label for="fullname" class="formbold-form-label">
                            Payment Mode
                        </label>
                        <select name="payment" id="payment" class="formbold-form-input">
                            <option value="upi">UPI</option>
                            <option value="cash">CASH</option>
                        </select>
                    </div>
                </div>
                <div class="formbold-input-flex">
                    <div>
                        <label for="transaction" class="formbold-form-label"> Transaction Id</label>
                        <input type="text" name="transaction" class="formbold-form-input" />
                    </div>
                    <div>
                        <label class="formbold-form-label">College Name</label>
                        <input type="text" name="college" class="formbold-form-input" required />
                    </div>
                </div>
                <button class="formbold-btn">Register Now</button>
            </form>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .formbold-mb-3 {
            margin-bottom: 15px;
        }

        .formbold-relative {
            position: relative;
        }

        .formbold-opacity-0 {
            opacity: 0;
        }

        .formbold-stroke-current {
            stroke: currentColor;
        }

        #supportCheckbox:checked~div span {
            opacity: 1;
        }

        .formbold-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;

        }

        .formbold-form-wrapper {
            margin: 0 auto;
            max-width: 100%;
            width: 100%;
            background: white;
            padding: 40px;
        }

        .formbold-img {
            margin-bottom: 45px;
        }

        .formbold-form-title {
            margin-bottom: 30px;
        }

        .formbold-form-title h2 {
            font-weight: 600;
            font-size: 28px;
            line-height: 34px;
            color: #07074d;
        }

        .formbold-form-title p {
            font-size: 16px;
            line-height: 24px;
            color: #536387;
            margin-top: 12px;
        }

        .formbold-input-flex {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .formbold-input-flex>div {
            width: 50%;
        }

        .formbold-form-input {
            width: 100%;
            padding: 13px 22px;
            border-radius: 5px;
            border: 1px solid #dde3ec;
            background: #ffffff;
            font-weight: 500;
            font-size: 16px;
            color: #536387;
            outline: none;
            resize: none;
        }

        .formbold-form-input:focus {
            border-color: #6a64f1;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }

        .formbold-form-label {
            color: #536387;
            font-size: 14px;
            line-height: 24px;
            display: block;
            margin-bottom: 10px;
        }

        .formbold-checkbox-label {
            display: flex;
            cursor: pointer;
            user-select: none;
            font-size: 16px;
            line-height: 24px;
            color: #536387;
        }

        .formbold-checkbox-label a {
            margin-left: 5px;
            color: #6a64f1;
        }

        .formbold-input-checkbox {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        .formbold-checkbox-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            margin-right: 16px;
            margin-top: 2px;
            border: 0.7px solid #dde3ec;
            border-radius: 3px;
        }

        .formbold-btn {
            font-size: 16px;
            border-radius: 5px;
            padding: 14px 25px;
            border: none;
            font-weight: 500;
            background-color: #6a64f1;
            color: white;
            cursor: pointer;
            margin-top: 25px;
        }

        .formbold-btn:hover {
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const game = document.getElementById('game');
            const category = document.getElementById('category');

            const data = {
                FREE_FIRE: { categories: { Solo: 75, Duo: 150, Squad: 300 } },
                BGMI: { categories: { Solo: 75, Duo: 150, Squad: 300 } },
                COD: { categories: { "Per Team": 350, "Per Player": 70 } },
                VALORANT: { categories: { "Per Team": 400, "Per Player": 80 } },
                EFOOTBALL: { price: 60 },
                CLASH_ROYALE: { price: 60 }
            };

            game.addEventListener('change', () => {
                category.innerHTML = '<option value="">Select Category</option>';

                const selected = game.value;
                if (!selected) return;

                if (data[selected].categories) {
                    Object.keys(data[selected].categories).forEach(cat => {
                        const opt = document.createElement('option');
                        opt.value = cat;
                        opt.textContent = cat;
                        category.appendChild(opt);
                    });
                } else {
                    const opt = document.createElement('option');
                    opt.value = 'Solo';
                    opt.textContent = 'Solo';
                    category.appendChild(opt);
                }
            });
        });
    </script>

@endsection