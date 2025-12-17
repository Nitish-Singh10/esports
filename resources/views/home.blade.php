<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-900 flex items-center justify-center p-4">

    <div id="formCard" class="w-full max-w-3xl bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8 md:p-10">

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
            🎮 Ekshetra Registration
        </h2>

        <form method="POST" action="/register" class="space-y-6">

            <!-- Game & Category -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Game</label>
                    <select id="game" name="game"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                        <option value="">Select Game</option>
                        <option value="FREE_FIRE">Free Fire</option>
                        <option value="BGMI">BGMI</option>
                        <option value="COD">COD Mobile</option>
                        <option value="VALORANT">Valorant</option>
                        <option value="EFOOTBALL">E Football</option>
                        <option value="CLASH_ROYALE">Clash Royale</option>
                    </select>
                </div>

                <div id="categoryBox">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Category</label>
                    <select id="category" name="category"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </select>
                </div>
            </div>

            <!-- QR & Amount -->
            <div class="flex flex-col items-center text-center mt-8 space-y-4">
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <img src="upi.jpg" alt="Scan to Pay" class="w-48 h-48 object-contain rounded-lg">
                </div>

                <p id="amountText" class="text-xl font-semibold text-gray-800">
                    Select game & category to see amount
                </p>
            </div>

            <!-- User Details -->
            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                    <input type="text" name="name"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Phone No</label>
                    <input type="text" name="phone"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                    <input type="email" name="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">College Name</label>
                    <input type="text" name="college"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">Transaction ID</label>
                <input type="text" name="transaction_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>
            </div>

            <!-- Hidden amount -->
            <input type="hidden" name="amount" id="amount">

            <button type="submit"
                class="w-full py-4 mt-6 text-lg font-semibold text-white rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:scale-[1.02] transition-transform">
                Submit Registration
            </button>

        </form>
    </div>

    <script>
        const game = document.getElementById('game');
        const category = document.getElementById('category');
        const categoryBox = document.getElementById('categoryBox');
        const amountText = document.getElementById('amountText');
        const amountInput = document.getElementById('amount');

        const data = {
            FREE_FIRE: { categories: { Solo: 75, Duo: 150, Squad: 300 } },
            BGMI: { categories: { Solo: 75, Duo: 150, Squad: 300 } },
            COD: { categories: { "Per Team": 350, "Per Player": 70 } },
            VALORANT: { categories: { "Per Team": 400, "Per Player": 80 } },
            EFOOTBALL: { price: 60 },
            CLASH_ROYALE: { price: 60 }
        };

        function updateAmount(value) {
            amountText.textContent = `Amount to Pay: ₹${value}`;
            amountInput.value = value;

            gsap.fromTo(amountText,
                { scale: 0.9, opacity: 0 },
                { scale: 1, opacity: 1, duration: 0.4 }
            );
        }

        game.addEventListener('change', () => {
            category.innerHTML = '';
            amountText.textContent = 'Select game & category to see amount';
            amountInput.value = '';

            const selected = game.value;
            if (!selected) return;

            if (data[selected].categories) {
                categoryBox.classList.remove('hidden');

                Object.entries(data[selected].categories).forEach(([cat, price]) => {
                    const opt = document.createElement('option');
                    opt.value = cat;
                    opt.textContent = cat;
                    category.appendChild(opt);
                });

                updateAmount(data[selected].categories[category.value]);
            } else {
                categoryBox.classList.add('hidden');
                updateAmount(data[selected].price);
            }
        });

        category.addEventListener('change', () => {
            updateAmount(data[game.value].categories[category.value]);
        });

        // GSAP Entry Animation
        gsap.from("#formCard", {
            y: 60,
            opacity: 0,
            duration: 0.8,
            ease: "power3.out"
        });
    </script>

</body>

</html>