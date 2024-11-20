document.addEventListener('DOMContentLoaded', function(){
    const  checklistForm = document.querySelector('.proacto-form')
    if (checklistForm) {
        console.log(calculateMaxPoints());
        const checklistSteps = checklistForm.querySelectorAll('.checklist-step')
        const checklistPrevs = checklistForm.querySelectorAll('.checklist-nav__prev')
        const checklistNexts = checklistForm.querySelectorAll('.checklist-nav__next')

        const progressBarThumb = document.querySelector('.checklist-baner__progressbar-tumb');
        const progressBarLabel = document.querySelector('.checklist-baner__progressbar-label');


        updateProgressBar(checklistSteps, progressBarThumb, progressBarLabel)

        checklistPrevs.forEach(prev => {
            prev.addEventListener('click', function(e) {
                e.preventDefault()
                let step = prev.getAttribute('data-step')
                checklistSteps.forEach(block => {
                    if (block.getAttribute('data-step') === step) {
                        block.classList.remove('hidden')
                    } else {
                        block.classList.add('hidden')
                    }
                })
                updateProgressBar(checklistSteps, progressBarThumb, progressBarLabel)
            })
        })

        checklistNexts.forEach(next => {

            next.addEventListener('click', function(e) {
                e.preventDefault()

                let current = parseInt(next.getAttribute('data-step')) - 1
                let isStepValid = validateStep(current)
                // console.log('isStepValid', isStepValid)

                if (isStepValid) {
                    if (next.type !== 'submit') {
                        let step = next.getAttribute('data-step')
                        checklistSteps.forEach(block => {
                            if (block.getAttribute('data-step') === step) {
                                block.classList.remove('hidden')
                            } else {
                                block.classList.add('hidden')
                            }
                        })
                    } else {
                        let points = countPoints()
                        showLoading(points)
                        //
                        // createCircleChart('checklist-final__circle', '#70F1AE', points);
                        // showFinal(points)
                    }
                }
                updateProgressBar(checklistSteps, progressBarThumb, progressBarLabel)
            })
        })
    }

    function showLoading(points) {
        const loadingBlock = document.querySelector('.checklist-loading')
        const banerTexts = document.querySelectorAll('.checklist-baner__text')
        let stepBlocks = document.querySelectorAll('.checklist-step')
        const progressBar = document.querySelector('.checklist-baner__progressbar');


        if(banerTexts) {
            banerTexts.forEach(text => {
                if (text.classList.contains('loading')) {
                    text.classList.remove('hidden')
                } else {
                    text.classList.add('hidden')
                }
            })
        }

        progressBar.style.display = 'none';
        console.log('progressBar', progressBar)

        stepBlocks.forEach(step => {
            step.classList.add('hidden')
        })

        if(loadingBlock) {
            loadingBlock.classList.remove('hidden')
        }
        window.setTimeout(function (){
            showFinal(points)
        }, 2000)
    }

    function validateStep(stepNum) {
        let isValid = false;
        let blockIsValid = false;
        const stepSection = checklistForm.querySelector('.checklist-step[data-step="'+stepNum+'"]')
        if (stepSection) {
            let errCounter = 0
            const stepBlocks = stepSection.querySelectorAll('.checklist-block')
            stepBlocks.forEach(block => {
                const textInputs = block.querySelectorAll('input[type="text"]');
                const checkboxes = block.querySelectorAll('input[type="checkbox"]');
                const radioButtons = block.querySelectorAll('input[type="radio"]');



                if (textInputs.length > 0) {
                    isValid = Array.from(textInputs).every(input => input.value.trim() !== '');
                } else if (checkboxes.length > 0) {
                    // checkboxes.forEach(ch => {
                    //     console.log('ch', ch.checked)
                    // })

                    isValid = Array.from(checkboxes).some(checkbox => checkbox.checked);
                    // console.log ('checkboxes', isValid)
                } else if (radioButtons.length > 0) {
                    isValid = Array.from(radioButtons).some(radio => radio.checked);
                }

                if (isValid) {
                    block.classList.remove('error')
                } else {
                    block.classList.add('error')
                }

                if (!isValid) {
                    errCounter++
                }


            });

            blockIsValid = errCounter === 0;

            return blockIsValid
        }

        return blockIsValid
    }

    function calculateMaxPoints() {
        let totalPoints = 0;

        // Select all checklist blocks
        document.querySelectorAll('.checklist-block').forEach(block => {
            const blockWeight = parseInt(block.getAttribute('data-weight')) || 1; // Default block weight to 1
            let blockPoints = 5;

            // Process inputs within the block
            // let maxWeight = 0;
            // block.querySelectorAll('input').forEach(input => {
            //     const inputWeight = parseInt(input.getAttribute('data-weight')) || 0;
            //     if (input.type === 'radio') {
            //         // Add weight of selected radio button
            //         const weight = parseInt(input.getAttribute('data-weight'), 10); // Get data-weight as an integer
            //         if (weight > maxWeight) {
            //             maxWeight = weight;
            //             blockPoints += weight;
            //         }
            //     } else if (input.type === 'text') {
            //         // Multiply weight by text input value
            //         const inputValue = 5;
            //         blockPoints += inputWeight * inputValue;
            //     }
            //     console.log('-----------')
            // });

            // Multiply block points by block weight
            totalPoints += blockPoints * blockWeight;
        });

        return totalPoints;
    }

    function countPoints() {
        const formBlocks = checklistForm.querySelectorAll('.checklist-block:not(.checklist-baner)')
        if (formBlocks) {
            var formSum = 0
            formBlocks.forEach(block => {
                let blockWeight = parseInt(block.getAttribute('data-weight'))
                let blockSum = 0
                if (block.classList.contains('choises')) {
                    const blockFields = block.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked')
                    blockFields.forEach(field => {
                        let choiseWeight = parseInt(field.getAttribute('data-weight'))
                        blockSum += choiseWeight
                        console.log('choiseWeight', choiseWeight)
                    })
                } else {
                    const blockFields = block.querySelectorAll('input')
                    blockFields.forEach(field => {
                        let textWeight = field.getAttribute('data-weight')
                        let textValue = parseInt(field.value)
                        console.log('textValue', textValue)
                        if (isNaN(textValue)) {
                            textValue = 0;
                        }

                        blockSum += textWeight * textValue
                    })
                }
                formSum += blockSum * blockWeight
            })

            let formPercents = formSum / calculateMaxPoints() * 100
            return formPercents

        }
    }

    function createCircleChart(containerId, color, percentage) {
        const container = document.getElementById(containerId);

        if (percentage > 100) {
            percentage = 100
        }

        const circleColor = percentage > 0 && percentage <= 100 ? color : '#dfdfdf';

        const svgNS = 'http://www.w3.org/2000/svg';

        const svg = document.createElementNS(svgNS, 'svg');
        svg.setAttribute('viewBox', '0 0 36 36');

        const circleBg = document.createElementNS(svgNS, 'path');
        circleBg.setAttribute('class', 'circle-bg');
        circleBg.setAttribute('d', 'M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831');
        svg.appendChild(circleBg);

        const circle = document.createElementNS(svgNS, 'path');
        circle.setAttribute('class', 'circle');
        circle.setAttribute('d', 'M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831');
        circle.setAttribute('stroke-dasharray', `${percentage}, 100`);
        circle.setAttribute('style', `stroke: ${circleColor}`);
        svg.appendChild(circle);

        const text = document.createElementNS(svgNS, 'text');
        text.setAttribute('x', '18');
        text.setAttribute('y', '20.35');
        text.setAttribute('class', 'percentage');
        text.setAttribute('style', `fill: ${circleColor}`);
        text.textContent = `${percentage}%`;
        svg.appendChild(text);

        container.appendChild(svg);
    }

    function showFinal(percentage) {
        let finalBlock = document.querySelector('.checklist-final')
        const loadingBlock = document.querySelector('.checklist-loading')

        const banerTexts = document.querySelectorAll('.checklist-baner__text')
        if(banerTexts) {
            banerTexts.forEach(text => {
                if (text.classList.contains('final')) {
                    text.classList.remove('hidden')
                } else {
                    text.classList.add('hidden')
                }
            })
        }

        if (loadingBlock) {
            loadingBlock.classList.add('hidden')
        }

        if (finalBlock) {

            console.log('percentage', percentage)

            if (percentage >= 0 && percentage <= 49) {
                changeFinals(finalBlock, 'low', percentage)
            } else if (percentage > 49 && percentage <= 79) {
                changeFinals(finalBlock, 'medium', percentage)
            } else if (percentage > 79 && percentage <= 100) {
                changeFinals(finalBlock, 'high', percentage)
            }
        }
        finalBlock.classList.remove('hidden')
    }

    function changeFinals(finalBlock, activeStatus, percentage) {

        const finalTitles = finalBlock.querySelectorAll('.checklist-final__title')
        const finalTexts = finalBlock.querySelectorAll('.checklist-final__text')
        const finalDiagramPathes = finalBlock.querySelectorAll('.checklist-final__diagram svg path')
        const finalPercentage = finalBlock.querySelector('.checklist-final__diagram_percentage')
        const finalPercentageNum = finalPercentage.querySelector('span')

        finalTitles.forEach(title => {
            if(title.classList.contains(activeStatus)) {
                title.classList.remove('hidden')
            } else {
                title.classList.add('hidden')
            }
        })
        finalTexts.forEach(text => {
            if(text.classList.contains(activeStatus)) {
                text.classList.remove('hidden')
            } else {
                text.classList.add('hidden')
            }
        })
        finalDiagramPathes.forEach(path => {
            if(path.classList.contains(activeStatus)) {
                path.classList.add('active')
            } else {
                path.classList.remove('active')
            }
        })

        finalPercentage.classList.add(activeStatus);
        animatePercentage(finalPercentageNum, percentage)
        console.log('percentage', percentage)
    }

    function animatePercentage(finalPercentageNum, percentage) {
        let currentValue = 0; // Starting value
        const duration = 2000; // Animation duration in milliseconds (2 seconds)
        const startTime = performance.now(); // Get the starting timestamp

        function update() {
            const currentTime = performance.now();
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1); // Ensure progress doesn't go beyond 1

            currentValue = Math.floor(progress * percentage); // Calculate the current value based on the progress
            finalPercentageNum.textContent = currentValue; // Update the element's text

            if (progress < 1) {
                requestAnimationFrame(update); // Continue the animation
            }
        }

        requestAnimationFrame(update); // Start the animation
    }



    function updateProgressBar(checklistSteps, progressBarThumb, progressBarLabel) {
        // Find the current active step
        const activeSection = document.querySelector('.checklist-step:not(.hidden)');

        if (activeSection && checklistSteps) {
            const currentStep = parseInt(activeSection.getAttribute('data-step'), 10);
            const activeProgress = activeSection.getAttribute('data-progress');
            const totalSteps = checklistSteps.length;

            // Calculate the width percentage for the progress bar thumb
            const minPercentage = 5; // Start with 5% for the first step
            const maxPercentage = 95; // 95% for the last step

            const progressPercentage = minPercentage + ((currentStep - 1) / (totalSteps - 1)) * (maxPercentage - minPercentage);

            // Set the width of the progress bar thumb
            progressBarThumb.style.width = `${progressPercentage}%`;
            progressBarLabel.style.left = `${progressPercentage}%`;
            progressBarLabel.textContent = activeProgress;
        }
    }

    // Initial call to set progress on load
    updateProgressBar();
});