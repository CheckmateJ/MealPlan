import './styles/app.css';
import Vue from 'vue';
import deleteConfirmation from './components/deleteConfirmation';
import Course from './Vue/Course';
import mealPlan from './Vue/MealPlan';




new Vue({
    el: '#app',
    render(h) {
        return h(Course, {
            props: {
                config: JSON.parse(this.$el.attributes['data-init-value'].value),
                ingredients: JSON.parse(this.$el.attributes['data-ingredients-value'].value),
                courseName: this.$el.attributes['data-course-name'].value,
            }
        })
    }
})

new Vue({
    el: '#mealPlan',
    render(h) {
        return h(mealPlan, {
            props: {
                days: JSON.parse(this.$el.attributes['data-days'].value),
                meals: JSON.parse(this.$el.attributes['data-meals'].value),
                courses: JSON.parse(this.$el.attributes['data-course'].value),
                mealPlanItem: JSON.parse(this.$el.attributes['data-meal-plan-item'].value)
            }
        },
        )
    }
})

