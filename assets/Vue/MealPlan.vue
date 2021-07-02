<template>
  <div class="text-center ">
    <h3 class="header-meal-plan">{{ this.title }}</h3>
    <form name="meal_plan" method="post">
      <div class="form-floating course">
        <input name="meal_plan[name]" type="text" required id="meal_plan"
               class="form-control meal_plan text-center" placeholder="Meal plan"
               required="required" :value="mealPlanItem.length > 0 ? mealPlanItem[0].mealPlan.name : ''">
        <label for="meal_plan" style="margin-left: 40px">Meal plan name</label>
      </div>
      <table class="table table-bordered">
        <thead>
        <tr class="text-center">
          <th></th>
          <th scope="col" v-for="meal in meals">{{ meal }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(day,index) in days" class="text-center">
          <td style="font-weight: bold">{{ day }}</td>
          <td v-for="(meal,i) in meals">
            <input class="visually-hidden" v-bind:name="`meal_plan[mealPlanItem][${index * meals.length + i }][day]`"
                   v-bind:value="day"
                   required="required">
            <input class="visually-hidden" v-bind:name="`meal_plan[mealPlanItem][${index * meals.length + i }][meal]`"
                   v-bind:value="meal"
                   required="required">
            <select class="select-option form-select form-select-sm"
                    v-bind:name="`meal_plan[mealPlanItem][${index * meals.length + i }][course]`"
                    v-bind:value="initValues[day][meal] ? initValues[day][meal].id : null">
              <option :value="null" disabled>{{ selectCourse }}</option>
              <option
                  v-for="course in courses"
                  v-bind:value="course.id"
              >{{ course.name }}
              </option>
            </select>
          </td>
        </tr>
        </tbody>
      </table>
      <div class="fa-text-width">
      <button type="submit" class="btn btn-success save-button" name="meal_plan[save]">Save</button>
      <a @click="backPage" type="submit" class="btn btn-primary button-back">Back</a>
      <button type="submit" value="report" class="btn btn-success save-button" name="meal_plan[report]">Report</button>
      </div>
    </form>
  </div>
</template>
<script>

export default {
  props: ['days', 'courses', 'meals', 'mealPlanItem'],

  beforeMount() {
    this.days.map(day => this.initValues[day] = {})
    for (let i = 0; i < this.mealPlanItem.length; i++) {
      if (this.mealPlanItem[i].course != null) {
        this.initValues[this.mealPlanItem[i].day][this.mealPlanItem[i].meal] = this.mealPlanItem[i].course;
      }
    }
  },

  data() {
    return {
      title: 'Meal Plan',
      selectCourse: '------Course------',
      initValues: {}
    }
  },
  methods: {
    backPage() {
      window.history.back();
    }
  }

}
</script>