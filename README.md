#  ARIMA Time Series Forecasting - Retail Inventory

This project demonstrates the use of the ARIMA (AutoRegressive Integrated Moving Average) algorithm for forecasting monthly unit sales across different product categories in a retail store dataset using Python.

---

##  Project Overview

The notebook `Arima_algorithm.ipynb` performs the following tasks:

- Loads retail inventory data from a CSV file.
- Processes the date column to create monthly aggregates (`YearMonth`).
- Groups data by category to get total monthly sales.
- Applies the ARIMA model to each category to forecast future sales.
- Handles errors gracefully for categories with insufficient data.
- Stores the final forecasts for all valid categories.

---

##  Dataset

The dataset used is named:  
`retail_store_inventory.csv`

It is expected to contain at least the following columns:

- `Date`: The date of the sale
- `Category`: Product category (e.g., Electronics, Apparel)
- `Units Sold`: Number of units sold on that date

---

##  Methods Used

- **Pandas** for data cleaning and manipulation
- **statsmodels** for time series modeling (`ARIMA`)
- **Datetime formatting** to align time series
- **Groupby aggregation** to prepare monthly data
- **Looping per category** for independent forecasts

---

##  Model: ARIMA

ARIMA is used here to:
- Detect patterns in the time series for each category
- Forecast the **next period's unit sales**
- Avoid forecasting on insufficient data (e.g., less than 10 data points)

---

##  How to Run the Notebook

### 1. Clone the repository
file: `Arima_algorithm.ipymb`

### 2. Install required libraries
Bash:
`pip install pandas statsmodels`

### 3. Place your dataset
Make sure your dataset retail_store_inventory.csv is placed in the correct path.
If needed, edit the path inside the notebook:

df = pd.read_csv("path/to/retail_store_inventory.csv")

### 4. Run the notebook
Open the notebook with Jupyter or VS Code:
Bash:
`jupyter notebook Arima_algorithm.ipynb`

## Output
The script stores forecasted results in a list and handles categories that cannot be processed due to insufficient data.

## Author
Created by Shreeya Salunkhe
For internal forecasting and data science project demonstration.

## 📽️ Video Demo

🎬 [Watch the demo video on Google Drive](https://drive.google.com/file/d/1su1N8VBBV1NralPhPq0xm0xHmR6ET6RW/view?usp=sharing)

