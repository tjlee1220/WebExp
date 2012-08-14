==============
How-To: WebExp
==============

Setting up a new Task
=====================

A task is defined as a set of blocks that is assigned to a subject. Within the WebExp SQL database, the table for 
tasks contains five columns. The first column is the Primary id, which keeps track of each individual entry into the table.
The next column, 'blocks', contains the blocks that the subject will be taken through while participating in the task. 
This is the most important column when it comes to creating a new task. The 'blocks' column contains a serialized php array 
that describes which blocks to assign to the subject and in what order. In order to explain the specifics of creating a 
new task, an example array will be used:

::

    a:2:{i:0;i:4;i:1;i:5;}

The 'a:2:' part of the string tells PHP, and the person reading it, that this string represents an array with two
values. The serialized array is presented in key => value pairs. For example, in the demo array, 'i:0;i:4;' is the
first key => value pair and looks like '0 => 4' in unserialized form. In all programming languages, arrays start with
0 not 1. This means that the first value in this serialized array is 4. The second value in the array, 'i:1;i:5', is
5. The values reprsent the id number of the block that the subject will be taken through. Meaning, that if a subject
was assigned this demo task, they would first go through the block with an id of 4, then the block with an id of 5, 
then the task would end.

If you wanted to create a task in which the subject went through three blocks, with the
respective id numbers of 1, 2, and 3, then you would have to create your own array to insert into this 'blocks' 
column. First, you would begin your array with: 

::
	
    a:3:{}

This means that you are creating an array with three key => value pairs.

Next, you would insert these key => value pairs into your serialized array and your finished product would look like
this:

::

    a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}

The unserialized form of this array would look like this:

::

    array(
      0 => 1,
      1 => 2,
      2 => 3,
    );

The next column is the 'name' column. This column is pretty self-explanatory and simply contains the name of the 
task. The next column is 'notes', which is optional, and can contain any notes on the task you would want to add.
The final column is the timestamp column which automatically records the date and time at which the task was created.

To create a new task, you must go to the 'tasks' table and locate the insert button along the top of the screen. Here,
you will be presented with a blank form where you can input values for each column within the table. The 'id' and
'timestamp' columns are automatically generated so you will not have to input any values. Follow the instructions from
above to input a serialized php array that will govern which blocks the subject will be taken through.

Exporting to various formats
============================

PhpMyAdmin makes it very easy to export anything to csv format. The most common thing that you will export will most
likely be the results table but this same process works for any table. First, select the table that you want to export.
Then, look for the 'Export' tab along the top of the page. Select this tab and you will be presented with a variety
of options. You can export the data to a .csv file, an excel file, or many other file types. Once you have 
selected all the options you want, simply hit go and the file will be downloaded to your computer. 

Note that SQL has a memory limit on the amount of data it can export at a single time. Make sure to check the downloaded
file to see if all the data was exported correctly.

Generating new Subjects
=======================

To create new subjects to participate in a task, you must visit the 'subjects' table. Within the subjects table, locate
the 'Insert' tab along the top. You will be presented with a blank form with inputs for 'id', 'md5_identifier',
'assigned_task', 'notes', and 'timestamp'. The 'id' and 'timestamp' columns are automatically generated so you will not
have to input any values for them. The 'md5_identifier' column must contain a unique number that is used to keep track
of a subject while participating in a task. The 'assigned_task' column must contain the id number of the task you wish
this particular subject to carry out (See 'Setting up a new Task').

Description of Database Tables
==============================

Blocks
------

Blocks are individual experiments that subjects participate in. A single block or multiple blocks make up a task
which is then assigned to the subject (See "Setting Up a New Task"). The 'blocks' table contains a variety of
information that describes each block. The first column is the Primary_id that SQL uses to keep track of every
individual entry.

The next column is 'exp_id' or experiment id which is linked to the 'experiments' table which
describes stiumulus mapping within each block.

The 'name' column contains the name of the block and it is displayed as the title of block_view.php when viewed by the
subject.

The 'instruction_text' column contains the instructions for each block that is displayed to the user when they are
viewing the block_view.php html document.

The 'notes' column is optional and is there for anything that you would want to write about a block.

The 'timeout' column contains an integer value that describes the amount of time, in milliseconds, alloted to the user
to respond to the stimulus presented in a trial.

'fb_time', also an integer value that represents milliseconds, tells the program how long to keep feedback on the screen
after the subject has responded to a stimulus.

'fixation_time', another integer value that represents milliseconds, controls how long the fixation cross '+' is shown
before a stimulus is presented to the subject.

The 'positive_img','negative_img',and 'neutral_img' columns provide the url of the image that is to be presented along
with positive, negative, and neutral feedback.

The 'timestamp' column is automatically generated and gives the time and date of the block's creation.

The 'js_file' column provides the javascript file that is to be used for that specific block to govern any
interactivity. The 'prac_js" column has the same function except that it is used for the practice portion of that block
instead of the main trial.

The 'valid_responses' column contains a serialized php array (See 'Setting Up a new Task') that describes which keys are
considered valid responses during the block. The default value for this column is:

::

    a:2:{i:0;s:1:"d";i:1;s:1:"k";}

This particular array provides 'd' and 'k' as the two valid responses to a stimulus. The 'd' and 'k' keys
are there by default but can be substituted for any other set of keys.

The 'trial_type' column can contain either '1' or '2'. '1' means that the block is a training block and '2' means that
the block is a test block.

The final 'practice' column contains either '0' or '1'. '0' means that practice is turned off for that block and '1'
means that practice is turned on. If practice is turned on then the subject will have to complete a practice phase
before starting the main trial. Be sure to provide a 'prac_js' file if practice is turned on for a block.

Results
-------

The results table contains all the information on a subject's individual performance in a block. The first
column 'Overall Trial Number Across Block' is the SQL Primary_id which keeps track of each individual entry. Each
entry in the table represents an individual trial, which is the presentation of a single stimulus or group of 
stimuli to the subject.

The next 'subject' column contains the subject number assigned to each subject through amazon mechanical turk. New
subjects and their assigned tasks can be created in the subjects table (See 'Creating new Subjects').

The 'trial_id' column contains an integer that is used to describe the individual trial. For example, the number '123'
could represent a trial with a blue stimlus presented on the left side of the screen with a condition of 3. In this 
example, '1' could represent a blue stimulus, '2' could represent the left side, and '3' could represent the trial's
condition, which will be explained later on (See 'Trials').

'trial_number_per_block' represents the order in which each stimulus is presented in its specific block.

'key_pressed' shows the key that was pressed by the user in response to the stimulus. 'no respo' simply means that the
subject did not provide a valid response within the alloted time. If the subject provides a valid response, then that
key will be inserted into the column. For example if the valid responses for a block are 'd' and 'k' and the subject
presses the 'd' key, then 'd' will be inserted into the column.

The 'stim_loc' is a somewhat redundant column that gives a '0' if the valid button on the left is pressed
i.e. 'd', a '1' if the valid button on the right is pressed i.e. 'k', and a '-1' if no valid key is pressed.

The 'feedback' column describes the type of feedback presented to the user based on their response to the stimulus. 
'1' denotes positive feedback, '0' denotes negative feedback, '2' denotes neutral feedback, '3' denotes no feedback
(which is common during test blocks), and '-1' denotes no response.

'reaction_time' shows, in milliseconds, how long it took for the subject to respond to a stimulus. '-1' is inserted if
no response is given. '

block_set_id' is unique for each individual block and is used to distinguish one block from another within the results.

The final column 'trial_type' is related to the 'trial_type' column from the 'blocks' table (See 'Blocks'). '1' denotes
a training block and '2' denotes a testing block. 

Trials
------

The 'trials' table contains the description of each individual trial that has been generated for the blocks. A trial
is simply the presentation of a single stimulus or group of stimuli that the subject then responds to. The first 'trial_id'
column is the Primary_id for the sql table, which keeps track of each entry.

The next column 'id' contains an integer value that describes the individual trial. A thorough explaination of how this
integer value can be used to describe the trial can be found in the 'Results' Section and will be quoted here:

::		

    The number '123' could represent a trial with a blue stimlus presented on the left side of the screen
    with a condition of 3. In this example, '1' could represent a blue stimulus, '2' could represent the
    left side, and '3' could represent the trial's condition, which will be explained later on.

The 'block_id' column holds the id number of the block that the trial is a part of.
The 'stims' column contains a serialized php array (See 'Setting Up a new Task') that describes which stimuli will be
presented during that trial.

The 'correct' column also contains a serialized php array that describes the feedback given by each stimulus in the
trial.

The 'condition' column holds 1, 2, 3, 4, or 0. '1' denotes a trial that always provides positive feedback. '2' denotes a
congruent trial, this could mean that if a yellow stimulus is presented on the left, then the subject wil receive
positive feedback, but if the yellow stimulus is presented on the right, the subject will receive neutral feedback.
'3' denotes an incongruent trial, this could mean that if a yellow stimulus is presented on the left, the subject will
receive neutral feedback for a correct response but will receive positive feedback if the yellow stimulus in presented
on the right side. Condition '4' denotes a trial that is never rewarding and will always provide neutral feedback for a
correct response. Condition '0' is used for testing phases where no feedback is provided to the subject.

Stimulus_Images
---------------

The 'stimulus_images' table contains all the information on the images used as stimuli in the blocks. The first column
is the Primary_id which tracks each entry into the table.

The next column is 'exp_id' which contains an integer to associate each image with conditions defined in the
'experiments' table. These conditions include randomization, preservation of stimulus mapping , and stimulus grouping.

The 'stim_id' column helps keep track of each image in its individual block.

The 'img' column contains the source url of the image so it can be loaded within the program.

'stim_grp' is used group to stimuli together if they are to be presented together.

The 'notes' column is once again optional and is used to provide any extra
description of the image. 

