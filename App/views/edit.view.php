<?php

/** @var array $validateErrors */

/** @var array $oldValues*/

namespace App\views;

use function App\util\loadTemplate;
loadTemplate('header');
//loadTemplate('heroSection');
loadTemplate('headline');
?>

<main class="main-create">
    <section>
        <h2>Update Job Listing</h2>
        <p>Job info</p>
        <form action="/listings/edit/<?= isset($oldValues->id) ? $oldValues->id : '' ?>" method="POST">
            <div class="input-container">
                <input id="title" type="text" name="title" placeholder="Job Title"
                    value="<?= isset($oldValues->title) ? $oldValues->title : '' ?>">
                <?php if(isset($validateErrors['title'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['title'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <textarea rows="4" cols="" name="description" placeholder="Description"><?=isset($oldValues->description) ? $oldValues->description : '' ?> </textarea>
                <?php if(isset($validateErrors['description'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['description'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="salary" type="text" name="salary" placeholder="Salary"
                    value="<?= isset($oldValues->salary) ? $oldValues->salary : '' ?>">
                <?php if(isset($validateErrors['salary'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['salary'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="requirements" type="text" name="requirements"
                    value="<?= isset($oldValues->requirements) ? $oldValues->requirements : '' ?>"
                    placeholder="Requirements">
                <?php if(isset($validateErrors['requirements'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['requirements'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="benefits" type="text" name="benefits"
                    value="<?= isset($oldValues->benefits) ? $oldValues->benefits : '' ?> " placeholder="Benefits">
                <?php if(isset($validateErrors['benefits'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['benefits'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="tags" type="text" name="tags" placeholder="Tags"
                    value="<?= isset($oldValues->tags) ? $oldValues->tags : '' ?>">
                <?php if(isset($validateErrors['tags'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['tags'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <h2>Company Info & Location</h2>
            <div class="input-container">
                <input id="company" type="text" name="company" placeholder="Company"
                    value="<?= isset($oldValues->company) ? $oldValues->company : '' ?>">
                <?php if(isset($validateErrors['company'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['company'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="address" type="text" name="address" placeholder="Address"
                    value="<?= isset($oldValues->address) ? $oldValues->address : '' ?>">
                <?php if(isset($validateErrors['address'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['address'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="city" type="text" name="city" placeholder="City"
                    value="<?= isset($oldValues->city) ? $oldValues->city : '' ?>">
                <?php if(isset($validateErrors['city'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['city'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="state" type="text" name="state" placeholder="State"
                    value="<?= isset($oldValues->state) ? $oldValues->state : '' ?>">
                <?php if(isset($validateErrors['state'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['state'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="phone" type="text" name="phone" placeholder="Phone"
                    value="<?= isset($oldValues->phone) ? $oldValues->phone : '' ?>">
                <?php if(isset($validateErrors['phone'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['phone'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="email" type="text" name="email" placeholder="Email"
                    value="<?= isset($oldValues->email) ? $oldValues->email : '' ?>">
                <?php if(isset($validateErrors['email'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['email'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <button class="btn-submit" type="submit">update</button>
            <a class="btn-cancel" href="#">cancel</a>
        </form>
    </section>
</main>

<?php
loadTemplate('footer');
?>
