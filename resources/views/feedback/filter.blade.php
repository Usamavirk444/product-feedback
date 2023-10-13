<div class="mb-4">
    <form method="get" action="{{ route('feedback.index') }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">All Categories</option>
                        <option value="bug">Bug Report</option>
                    <option value="feature">Feature Request</option>
                    <option value="improvement">Improvement</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sort">Sort By:</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="latest">Latest</option>
                        <option value="votes">Most Votes</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <button type="submit" class="btn btn-outline-primary">Apply Filters</button>
            </div>
        </div>
    </form>
</div>
