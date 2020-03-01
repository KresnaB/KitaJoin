
<template>
    <form>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="nameCom" id="nameCom" />
        </div>

        <div class="form-group">
            <label for="email">Contact</label>
            <input type="email" class="form-control" name="contactCom" id="contactCom" />
        </div>

        <div class="form-group">
            <label for="message">Description</label>
            <textarea class="form-control" name="descCom" id="descCom" rows="5"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Competition</button>
    </form>
</template>