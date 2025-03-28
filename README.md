# API Job Filtering Documentation

## **Query Parameters**
- `title` : Text search (e.g., `title[LIKE]=Developer`)
- `company_name` : Text search (e.g., `company_name[=]=Google`)
- `salary_min` : Numeric filter (e.g., `salary_min[>=]=5000`)
- `is_remote` : Boolean filter (e.g., `is_remote[=]=1`)
- `job_type` : Enum filter (e.g., `job_type[IN]=full-time,part-time`)
- `published_at` : Date filter (e.g., `published_at[>=]=2024-01-01`)
- `languages` : Relationship filter (e.g., `languages[HAS_ANY]=PHP,JavaScript`)
- `locations` : Relationship filter (e.g., `locations[IS_ANY]=New York,Remote`)
- `attribute:years_experience` : EAV filter (e.g., `attribute:years_experience[>=]=3`)

## **Example Requests**
```http
GET /api/jobs?filter=(job_type=full-time AND (languages HAS_ANY (PHP,JavaScript))) 
AND (locations IS_ANY (New York,Remote)) 
AND attribute:years_experience>=3
