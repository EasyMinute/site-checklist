document.addEventListener('DOMContentLoaded', function(){
    const  checklistForm = document.querySelector('.proacto-form')
    if (checklistForm) {
        const checklistSteps = checklistForm.querySelectorAll('.checklist-step')
        const checklistPrevs = checklistForm.querySelectorAll('.checklist-nav__prev')
        const checklistNexts = checklistForm.querySelectorAll('.checklist-nav__next')

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
                        createCircleChart('checklist-final__circle', '#70F1AE', points);
                        showFinal(points)
                    }
                }
            })
        })
    }

    function validateStep(stepNum) {
        let isValid = false;
        const stepSection = checklistForm.querySelector('.checklist-step[data-step="'+stepNum+'"]')
        if (stepSection) {
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


            });
        }

        return isValid
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
            return formSum
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
        let stepBlocks = document.querySelectorAll('.checklist-step')
        stepBlocks.forEach(step => {
            step.classList.add('hidden')
        })
        if (finalBlock) {
            const finalTitles = finalBlock.querySelectorAll('.checklist-final__title')
            const finalTexts = finalBlock.querySelectorAll('.checklist-final__text')
            if (percentage >= 0 && percentage <= 49) {
                finalTitles.forEach(title => {
                    if(title.classList.contains('low')) {
                        title.classList.remove('hidden')
                    } else {
                        title.classList.add('hidden')
                    }
                })
                finalTexts.forEach(text => {
                    if(text.classList.contains('low')) {
                        text.classList.remove('hidden')
                    } else {
                        text.classList.add('hidden')
                    }
                })
            } else if (percentage > 49 && percentage <= 79) {
                finalTitles.forEach(title => {
                    if(title.classList.contains('medium')) {
                        title.classList.remove('hidden')
                    } else {
                        title.classList.add('hidden')
                    }
                })
                finalTexts.forEach(text => {
                    if(text.classList.contains('medium')) {
                        text.classList.remove('hidden')
                    } else {
                        text.classList.add('hidden')
                    }
                })
            } else if (percentage > 79 && percentage <= 100) {
                finalTitles.forEach(title => {
                    if(title.classList.contains('hight')) {
                        title.classList.remove('hidden')
                    } else {
                        title.classList.add('hidden')
                    }
                })
                finalTexts.forEach(text => {
                    if(text.classList.contains('hight')) {
                        text.classList.remove('hidden')
                    } else {
                        text.classList.add('hidden')
                    }
                })
            }
        }
        finalBlock.classList.remove('hidden')
    }

    // Example usage
});