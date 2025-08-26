<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div id="viewRecordPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl w-96 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Rule Details</h2>
                <button id="closeViewPopup" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <?php foreach ($Ruledata as $Rule): ?>
            <form class="space-y-4">
                <div>
                    <label for="viewRuleName" class="block text-sm font-medium text-gray-700">Rule Title</label>
                    <input 
                        type="text" 
                        id="viewRuleName" 
                        name="Rule_title" 
                        readonly 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 p-2"
                        placeholder="<?= htmlspecialchars($Rule->Rule_title)?>"
                    >
                </div>

                

                <div>
                    <label for="viewRuleStatus" class="block text-sm font-medium text-gray-700">Last Updated</label>
                    <input 
                        type="text" 
                        id="last_updated" 
                        name="Last Updated" 
                        readonly 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 p-2"
                        placeholder="<?= htmlspecialchars($Rule->last_Updated)?>"
                    >
                </div>
                <div>
                    <label for="viewRuleDescription" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea 
                        id="viewRuleDescription" 
                        name="Description" 
                        readonly 
                        rows="4" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 p-2"
                        placeholder="<?= htmlspecialchars($Rule->Description)?>"
                    ></textarea>
                </div>

                <a href="<?= ROOT . htmlspecialchars($Rule->pdf) ?>" download="_blank">View Document</a>

                <div class="flex justify-end space-x-2 pt-4">
                    <!-- <button 
                        type="button" 
                        id="backButton" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors"
                    >
                        Back
                    </button> -->
                    <a href="<?=ROOT?>/agn/RandR">Back</a>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewPopup = document.getElementById('viewRecordPopup');
        const closeViewPopup = document.getElementById('closeViewPopup');
        const backButton = document.getElementById('backButton');

        // Close popup methods
        function closePopup() {
            window.location.href = "<?=ROOT?>/agn/RandR";
        }

        closeViewPopup.addEventListener('click', closePopup);
        backButton.addEventListener('click', closePopup);

        // Optional: Close popup when clicking outside the modal
        viewPopup.addEventListener('click', function(event) {
            if (event.target === viewPopup) {
                closePopup();
            }
        });
    });
    </script>
</body>
</html>