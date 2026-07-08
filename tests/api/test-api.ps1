# API Testing Script
# Set base URL dan API Key
$baseUrl = "http://localhost:8080/api"
$apiKey = "my-secret-token"
$headers = @{
    "Authorization" = "Bearer $apiKey"
    "Content-Type" = "application/json"
    "Accept" = "application/json"
}

# Test GET /api/products
Write-Host "=== Testing GET /api/products ===" -ForegroundColor Cyan
$response = Invoke-WebRequest -Uri "$baseUrl/products?page=1&per_page=10" -Headers $headers -UseBasicParsing
Write-Host "Status: $($response.StatusCode)" -ForegroundColor Green
Write-Host "Response:" -ForegroundColor Yellow
$response.Content | ConvertFrom-Json | ConvertTo-Json | Write-Host

# Test GET /api/products/1
Write-Host "`n=== Testing GET /api/products/1 ===" -ForegroundColor Cyan
$response = Invoke-WebRequest -Uri "$baseUrl/products/1" -Headers $headers -UseBasicParsing
Write-Host "Status: $($response.StatusCode)" -ForegroundColor Green
Write-Host "Response:" -ForegroundColor Yellow
$response.Content | ConvertFrom-Json | ConvertTo-Json | Write-Host

# Test GET /api/transactions
Write-Host "`n=== Testing GET /api/transactions ===" -ForegroundColor Cyan
$response = Invoke-WebRequest -Uri "$baseUrl/transactions?start=2026-07-08&end=2026-07-08&page=1&per_page=10" -Headers $headers -UseBasicParsing
Write-Host "Status: $($response.StatusCode)" -ForegroundColor Green
Write-Host "Response:" -ForegroundColor Yellow
$response.Content | ConvertFrom-Json | ConvertTo-Json | Write-Host

# Test Unauthorized (no token)
Write-Host "`n=== Testing Unauthorized (No Token) ===" -ForegroundColor Cyan
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/products" -UseBasicParsing
}
catch {
    Write-Host "Status: $($_.Exception.Response.StatusCode)" -ForegroundColor Red
    Write-Host "Response:" -ForegroundColor Yellow
    $_.Exception.Response.GetResponseStream() | ForEach-Object { [System.IO.StreamReader]::new($_).ReadToEnd() } | Write-Host
}

Write-Host "`n=== All tests completed ===" -ForegroundColor Green
