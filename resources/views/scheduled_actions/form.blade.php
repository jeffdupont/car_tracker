<div>
  <div class="form-group">
      <label ng-bind="label"></label>
      <select class="form-control" name="recurring-type" ng-model="schedule.type" ng-change="change()">
          <option value="daily">Daily</option>
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
      </select>
  </div>

  <p class="help-block">Select the rules to setup the date in the monthly template.</p>

  <div class="form-group">
      <div id="daily-options" ng-if="schedule.type == 'daily'">
          <label for="">Repeat On:</label>
          <div class="radio">
              <label>
                  <input type="radio" ng-model="schedule.option" value="week_day"> Week Days Only
              </label>
          </div>
          <div class="radio">
              <label>
                  <input type="radio" ng-model="schedule.option" value="every_day"> Every Day
              </label>
          </div>
      </div>

      <div id="weekly-options" ng-if="schedule.type == 'weekly'">
          <label for="">Repeat On:</label>
          <div>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_monday" ng-model="schedule.option.monday" value="monday"> Mon
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_tuesday" ng-model="schedule.option.tuesday" value="tuesday"> Tue
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_wednesday" ng-model="schedule.option.wednesday" value="wednesday"> Wed
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_thursday" ng-model="schedule.option.thursday" value="thursday"> Thu
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_friday" ng-model="schedule.option.friday" value="friday"> Fri
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_saturday" ng-model="schedule.option.saturday" value="saturday"> Sat
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" id="week_sunday" ng-model="schedule.option.sunday" value="sunday"> Sun
              </label>
          </div>
      </div>

      <div id="monthly-options" ng-if="schedule.type == 'monthly'">
          <label for="">Repeat On:</label>
          <div>
              <label for="txt_TaskTitle">Day:</label>
              <select class="form-control" name="day" ng-model="schedule.day">
                  <option ng-repeat="n in [] | range:31" value=""></option>
              </select>
          </div>
      </div>
  </div>
</div>
